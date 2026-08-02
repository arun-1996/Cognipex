import * as THREE from './three.module.min.js';
import { GLTFLoader } from './GLTFLoader.js';

const stage = document.querySelector( '[data-cogpace-brain]' );

if ( stage ) {
	const canvas = stage.querySelector( 'canvas' );
	const labelsLayer = stage.querySelector( '[data-brain-labels]' );
	const reduceMotion = window.matchMedia(
		'(prefers-reduced-motion: reduce)'
	).matches;
	const renderer = new THREE.WebGLRenderer( {
		alpha: true,
		antialias: true,
		canvas,
		powerPreference: 'high-performance',
	} );

	renderer.setClearColor( 0x000000, 0 );
	renderer.setPixelRatio( Math.min( window.devicePixelRatio, 1.75 ) );
	renderer.outputColorSpace = THREE.SRGBColorSpace;
	renderer.toneMapping = THREE.ACESFilmicToneMapping;
	renderer.toneMappingExposure = 1.06;

	const scene = new THREE.Scene();
	const camera = new THREE.PerspectiveCamera( 34, 1, 0.1, 100 );
	camera.position.set( 0, 0.2, 8.3 );

	const brain = new THREE.Group();
	brain.rotation.set( -0.12, -0.42, -0.04 );
	scene.add( brain );

	const anatomyLabels = [
		{ label: 'Prefrontal cortex', position: [ -1.72, 0.72, 0.58 ] },
		{ label: 'Frontal lobe', position: [ -1.5, 0.38, 0.78 ] },
		{ label: 'Parietal lobe', position: [ -0.12, 1.25, 0.72 ] },
		{ label: 'Occipital lobe', position: [ 1.55, 0.3, 0.7 ] },
		{ label: 'Temporal lobe', position: [ 0.55, -0.68, 0.92 ] },
		{ label: 'Cerebellum', position: [ -1.2, -0.88, 0.72 ] },
		{ label: 'Brainstem', position: [ -0.18, -1.25, 0.62 ] },
	].map( ( definition ) => {
		const element = document.createElement( 'span' );
		element.className = 'cogpace-brain-experience__label';
		element.textContent = definition.label;
		labelsLayer.append( element );

		return {
			element,
			position: new THREE.Vector3( ...definition.position ),
		};
	} );

	const ambientLight = new THREE.HemisphereLight( 0x9fddff, 0x010817, 1.65 );
	const keyLight = new THREE.DirectionalLight( 0xdff7ff, 4.8 );
	keyLight.position.set( -4, 5, 6 );
	const sideLight = new THREE.PointLight( 0x39aaff, 7.5, 10 );
	sideLight.position.set( 3, -0.5, 4 );
	scene.add( ambientLight, keyLight, sideLight );

	const cortexMaterial = new THREE.MeshPhysicalMaterial( {
		attenuationColor: new THREE.Color( 0x1677ad ),
		attenuationDistance: 2.1,
		clearcoat: 0.9,
		clearcoatRoughness: 0.16,
		color: 0x4b9aca,
		emissive: 0x0c4069,
		emissiveIntensity: 0.22,
		ior: 1.22,
		metalness: 0.02,
		opacity: 0.42,
		roughness: 0.22,
		side: THREE.DoubleSide,
		thickness: 1.5,
		transmission: 0.34,
		transparent: true,
		depthWrite: false,
	} );

	function createGlowMaterial( intensity, falloff ) {
		return new THREE.ShaderMaterial( {
			blending: THREE.AdditiveBlending,
			depthTest: false,
			depthWrite: false,
			fragmentShader: `
				uniform float uIntensity;
				uniform float uFalloff;
				varying vec3 vNormal;
				varying vec3 vViewDirection;
				void main() {
					float fresnel = pow(1.0 - max(dot(normalize(vNormal), normalize(vViewDirection)), 0.0), uFalloff);
					gl_FragColor = vec4(vec3(0.36, 0.78, 1.0), fresnel * uIntensity);
				}
			`,
			side: THREE.BackSide,
			transparent: true,
			uniforms: {
				uFalloff: { value: falloff },
				uIntensity: { value: intensity },
			},
			vertexShader: `
				varying vec3 vNormal;
				varying vec3 vViewDirection;
				void main() {
					vec4 modelViewPosition = modelViewMatrix * vec4(position, 1.0);
					vNormal = normalMatrix * normal;
					vViewDirection = -modelViewPosition.xyz;
					gl_Position = projectionMatrix * modelViewPosition;
				}
			`,
		} );
	}

	const innerMaterial = new THREE.MeshPhysicalMaterial( {
		blending: THREE.NormalBlending,
		clearcoat: 0.5,
		color: 0x77c9f2,
		depthTest: false,
		depthWrite: false,
		emissive: 0x17699c,
		emissiveIntensity: 0.34,
		opacity: 0.12,
		roughness: 0.26,
		transparent: true,
	} );

	function addInternalStructures() {
		const internalGroup = new THREE.Group();
		const lobeGeometry = new THREE.SphereGeometry( 1, 40, 28 );
		const lobes = [
			[ -1.05, 0.42, 0.15, 0.82, 0.62, 0.52 ],
			[ -0.25, 0.68, 0.08, 0.78, 0.58, 0.5 ],
			[ 0.62, 0.48, 0.02, 0.72, 0.6, 0.5 ],
			[ -0.7, -0.36, 0.14, 0.78, 0.52, 0.48 ],
			[ 0.25, -0.32, 0.08, 0.72, 0.5, 0.46 ],
		];
		lobes.forEach( ( [ x, y, z, sx, sy, sz ] ) => {
			const lobe = new THREE.Mesh( lobeGeometry, innerMaterial );
			lobe.position.set( x, y, z );
			lobe.scale.set( sx, sy, sz );
			lobe.renderOrder = 3;
			internalGroup.add( lobe );
		} );

		const core = new THREE.Mesh(
			new THREE.SphereGeometry( 0.48, 36, 24 ),
			innerMaterial.clone()
		);
		core.material.opacity = 0.18;
		core.scale.set( 1.05, 0.64, 0.7 );
		core.position.set( -0.05, -0.02, 0.28 );
		core.renderOrder = 4;
		internalGroup.add( core );

		const arc = new THREE.CatmullRomCurve3( [
			new THREE.Vector3( -0.85, 0.18, 0.46 ),
			new THREE.Vector3( -0.4, 0.62, 0.52 ),
			new THREE.Vector3( 0.2, 0.7, 0.5 ),
			new THREE.Vector3( 0.78, 0.36, 0.42 ),
		] );
		const arcMesh = new THREE.Mesh(
			new THREE.TubeGeometry( arc, 40, 0.075, 8, false ),
			innerMaterial.clone()
		);
		arcMesh.material.opacity = 0.23;
		arcMesh.renderOrder = 4;
		internalGroup.add( arcMesh );
		brain.add( internalGroup );
	}

	const neuralPulses = [];
	const neuralHubs = [];

	function addNeuralSignals() {
		const signalGroup = new THREE.Group();
		const pathMaterial = new THREE.MeshBasicMaterial( {
			blending: THREE.AdditiveBlending,
			color: 0x83d9ff,
			depthTest: false,
			depthWrite: false,
			opacity: 0.2,
			transparent: true,
		} );
		const pulseCoreGeometry = new THREE.SphereGeometry( 0.032, 12, 8 );
		const pulseGlowGeometry = new THREE.SphereGeometry( 0.075, 12, 8 );
		const pulseCoreMaterial = new THREE.MeshBasicMaterial( {
			blending: THREE.AdditiveBlending,
			color: 0xe8fbff,
			depthTest: false,
			depthWrite: false,
			transparent: true,
		} );
		const pulseGlowMaterial = new THREE.MeshBasicMaterial( {
			blending: THREE.AdditiveBlending,
			color: 0x36b9ff,
			depthTest: false,
			depthWrite: false,
			opacity: 0.2,
			transparent: true,
		} );
		const hubGeometry = new THREE.SphereGeometry( 0.055, 14, 10 );
		const networks = [
			{
				hub: [ -0.82, 0.2, 0.82 ],
				targets: [
					[ -1.58, 0.72, 0.48 ],
					[ -1.45, -0.28, 0.72 ],
					[ -0.64, 1.02, 0.62 ],
				],
			},
			{
				hub: [ 0.72, 0.24, 0.86 ],
				targets: [
					[ 1.5, 0.66, 0.5 ],
					[ 1.42, -0.38, 0.64 ],
					[ 0.55, 1.04, 0.58 ],
				],
			},
			{
				hub: [ -0.02, -0.52, 0.88 ],
				targets: [
					[ -0.78, -0.92, 0.52 ],
					[ 0.7, -0.86, 0.54 ],
					[ -0.18, 0.18, 1.02 ],
				],
			},
			{
				hub: [ 0.12, 0.32, -0.78 ],
				targets: [
					[ -1.22, 0.58, -0.46 ],
					[ 1.28, 0.76, -0.42 ],
					[ 0.72, -0.68, -0.62 ],
				],
			},
		];

		networks.forEach( ( network, networkIndex ) => {
			const hubPosition = new THREE.Vector3( ...network.hub );
			const hub = new THREE.Group();
			const hubCore = new THREE.Mesh(
				hubGeometry,
				pulseCoreMaterial.clone()
			);
			const hubGlow = new THREE.Mesh(
				hubGeometry,
				pulseGlowMaterial.clone()
			);
			hubGlow.scale.setScalar( 2.4 );
			hub.add( hubGlow, hubCore );
			hub.position.copy( hubPosition );
			hub.renderOrder = 7;
			signalGroup.add( hub );
			neuralHubs.push( { hub, phase: networkIndex * 1.7 } );

			network.targets.forEach( ( target, branchIndex ) => {
				const targetPosition = new THREE.Vector3( ...target );
				const firstControl = hubPosition
					.clone()
					.lerp( targetPosition, 0.34 );
				const secondControl = hubPosition
					.clone()
					.lerp( targetPosition, 0.68 );
				firstControl.y += ( branchIndex - 1 ) * 0.1;
				firstControl.z += 0.08;
				secondControl.x += branchIndex === 1 ? 0.08 : -0.05;
				const curve = new THREE.CatmullRomCurve3( [
					hubPosition.clone(),
					firstControl,
					secondControl,
					targetPosition,
				] );
				const path = new THREE.Mesh(
					new THREE.TubeGeometry( curve, 36, 0.007, 5, false ),
					pathMaterial
				);
				path.renderOrder = 6;
				signalGroup.add( path );

				const pulse = new THREE.Group();
				const pulseCore = new THREE.Mesh(
					pulseCoreGeometry,
					pulseCoreMaterial.clone()
				);
				const pulseGlow = new THREE.Mesh(
					pulseGlowGeometry,
					pulseGlowMaterial.clone()
				);
				pulse.add( pulseGlow, pulseCore );
				const offset = ( networkIndex * 0.23 + branchIndex * 0.31 ) % 1;
				curve.getPointAt( offset, pulse.position );
				pulse.renderOrder = 8;
				signalGroup.add( pulse );
				neuralPulses.push( {
					curve,
					offset,
					pulse,
					speed: 0.07 + branchIndex * 0.012,
				} );
			} );
		} );

		brain.add( signalGroup );
	}

	const loader = new GLTFLoader();
	loader.load(
		new URL( '../models/human-brain.glb', import.meta.url ).href,
		( gltf ) => {
			const model = gltf.scene;
			const sourceBox = new THREE.Box3().setFromObject( model );
			const sourceSize = sourceBox.getSize( new THREE.Vector3() );
			const scale =
				3.85 / Math.max( sourceSize.x, sourceSize.y, sourceSize.z );
			model.scale.setScalar( scale );

			const scaledBox = new THREE.Box3().setFromObject( model );
			const center = scaledBox.getCenter( new THREE.Vector3() );
			model.position.sub( center );
			model.rotation.set( 0, -Math.PI / 2, 0 );

			const modelMeshes = [];
			model.traverse( ( child ) => {
				if ( child.isMesh ) {
					modelMeshes.push( child );
				}
			} );
			modelMeshes.forEach( ( child ) => {
				const sourceMaterial = child.material;
				const detailedMaterial = cortexMaterial.clone();
				child.geometry.computeVertexNormals();
				if ( sourceMaterial.normalMap ) {
					detailedMaterial.normalMap = sourceMaterial.normalMap;
					detailedMaterial.normalScale.set( 0.55, 0.55 );
					detailedMaterial.needsUpdate = true;
				}
				child.material = detailedMaterial;
				child.castShadow = false;
				child.receiveShadow = false;

				const innerShell = new THREE.Mesh(
					child.geometry,
					innerMaterial.clone()
				);
				innerShell.material.opacity = 0.1;
				innerShell.position.copy( child.position );
				innerShell.quaternion.copy( child.quaternion );
				innerShell.scale.copy( child.scale ).multiplyScalar( 0.94 );
				innerShell.renderOrder = 2;
				child.parent.add( innerShell );

				[ [ 1.02, 0.2, 2.05 ] ].forEach(
					( [ glowScale, intensity, falloff ] ) => {
						const glow = new THREE.Mesh(
							child.geometry,
							createGlowMaterial( intensity, falloff )
						);
						glow.position.copy( child.position );
						glow.quaternion.copy( child.quaternion );
						glow.scale
							.copy( child.scale )
							.multiplyScalar( glowScale );
						glow.renderOrder = 1;
						child.parent.add( glow );
					}
				);
			} );

			brain.add( model );
			addInternalStructures();
			addNeuralSignals();
			stage.classList.add( 'is-loaded' );
		},
		undefined,
		() => {
			stage.classList.add( 'has-error' );
		}
	);

	let pointerDown = false;
	let pointerX = 0;
	let pointerY = 0;
	let targetRotationX = brain.rotation.x;
	let targetRotationY = brain.rotation.y;

	canvas.addEventListener( 'pointerdown', ( event ) => {
		pointerDown = true;
		pointerX = event.clientX;
		pointerY = event.clientY;
		canvas.setPointerCapture( event.pointerId );
	} );
	canvas.addEventListener( 'pointermove', ( event ) => {
		if ( ! pointerDown ) {
			return;
		}
		targetRotationY += ( event.clientX - pointerX ) * 0.008;
		targetRotationX += ( event.clientY - pointerY ) * 0.005;
		targetRotationX = THREE.MathUtils.clamp( targetRotationX, -0.75, 0.55 );
		pointerX = event.clientX;
		pointerY = event.clientY;
	} );
	canvas.addEventListener( 'pointerup', () => {
		pointerDown = false;
	} );
	canvas.addEventListener( 'keydown', ( event ) => {
		const step = 0.12;
		if ( event.key === 'ArrowLeft' || event.key === 'ArrowRight' ) {
			targetRotationY += event.key === 'ArrowLeft' ? -step : step;
			event.preventDefault();
		}
		if ( event.key === 'ArrowUp' || event.key === 'ArrowDown' ) {
			targetRotationX += event.key === 'ArrowUp' ? -step : step;
			event.preventDefault();
		}
	} );

	function resize() {
		const width = stage.clientWidth;
		const height = stage.clientHeight;
		if ( canvas.width !== width || canvas.height !== height ) {
			renderer.setSize( width, height, false );
			camera.aspect = width / height;
			camera.updateProjectionMatrix();
		}
	}

	const brainCenter = new THREE.Vector3();
	const cameraDirection = new THREE.Vector3();
	const labelPosition = new THREE.Vector3();
	const labelDirection = new THREE.Vector3();
	const projectedLabelPosition = new THREE.Vector3();

	function updateLabels() {
		brain.getWorldPosition( brainCenter );
		cameraDirection.copy( camera.position ).sub( brainCenter ).normalize();

		const labelCandidates = anatomyLabels
			.map( ( label ) => {
				labelPosition.copy( label.position );
				brain.localToWorld( labelPosition );
				labelDirection
					.copy( labelPosition )
					.sub( brainCenter )
					.normalize();
				projectedLabelPosition.copy( labelPosition ).project( camera );
				return {
					...label,
					facing: labelDirection.dot( cameraDirection ),
					x:
						( projectedLabelPosition.x * 0.5 + 0.5 ) *
						stage.clientWidth,
					y:
						( -projectedLabelPosition.y * 0.5 + 0.5 ) *
						stage.clientHeight,
				};
			} )
			.filter( ( label ) => label.facing > 0.12 )
			.sort( ( first, second ) => second.facing - first.facing );
		const visibleLabels = [];
		labelCandidates.forEach( ( candidate ) => {
			const hasRoom = visibleLabels.every( ( visibleLabel ) => {
				return (
					Math.hypot(
						candidate.x - visibleLabel.x,
						candidate.y - visibleLabel.y
					) >= 72
				);
			} );
			if ( hasRoom && visibleLabels.length < 3 ) {
				visibleLabels.push( candidate );
			}
		} );
		const visibleElements = new Set(
			visibleLabels.map( ( label ) => label.element )
		);

		anatomyLabels.forEach( ( label ) => {
			if ( ! visibleElements.has( label.element ) ) {
				label.element.classList.remove( 'is-visible' );
			}
		} );

		visibleLabels.forEach( ( label ) => {
			const opacity = THREE.MathUtils.smoothstep(
				label.facing,
				0.12,
				0.5
			);

			label.element.style.setProperty( '--label-x', `${ label.x }px` );
			label.element.style.setProperty( '--label-y', `${ label.y }px` );
			label.element.style.setProperty( '--label-opacity', opacity );
			label.element.classList.toggle(
				'is-label-left',
				label.x > stage.clientWidth * 0.55
			);
			label.element.classList.add( 'is-visible' );
		} );
	}

	const clock = new THREE.Clock();
	function render() {
		resize();
		const elapsed = clock.getElapsedTime();
		if ( ! reduceMotion && ! pointerDown ) {
			targetRotationY += 0.0013;
		}
		brain.rotation.x += ( targetRotationX - brain.rotation.x ) * 0.07;
		brain.rotation.y += ( targetRotationY - brain.rotation.y ) * 0.07;
		if ( ! reduceMotion ) {
			brain.position.y = Math.sin( elapsed * 0.72 ) * 0.07;
			neuralPulses.forEach( ( signal ) => {
				const progress = ( elapsed * signal.speed + signal.offset ) % 1;
				signal.curve.getPointAt( progress, signal.pulse.position );
				signal.pulse.scale.setScalar(
					0.78 + Math.sin( progress * Math.PI ) * 0.42
				);
			} );
			neuralHubs.forEach( ( signalHub ) => {
				signalHub.hub.scale.setScalar(
					0.88 + Math.sin( elapsed * 2.4 + signalHub.phase ) * 0.16
				);
			} );
		}
		updateLabels();
		renderer.render( scene, camera );
		window.requestAnimationFrame( render );
	}

	render();
}

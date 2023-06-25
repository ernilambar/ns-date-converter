import { createRoot } from '@wordpress/element';
import App from './App';

const container = document.getElementById( 'nsdc-app' );

if ( container ) {
	const root = createRoot( container );

	root.render( <App /> );
}

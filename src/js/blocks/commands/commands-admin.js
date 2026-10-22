/**
 * Admin-wide commands registration.
 */

import { createRoot } from 'react-dom/client';
import { registerPlugin } from '@wordpress/plugins';
import { useRefreshCSSFilesCommand } from './components/commands/RefreshCSSFiles';

/**
 * Commands admin component.
 *
 * @return {JSX.Element|null} The CommandsAdmin component.
 */
const CommandsAdmin = () => {
	const refreshCSSFilesModal = useRefreshCSSFilesCommand();
	return refreshCSSFilesModal;
};

// Works in the block editor.
registerPlugin( 'mrshortcuts-gb-commands-admin', {
	render: CommandsAdmin,
} );

// Works in the admin area (non-block editor).
// Attach to admin footer div.
const rootElement = document.getElementById( 'mrshortcuts-gb-commands-admin' );
if ( rootElement ) {
	const root = createRoot( rootElement );
	root.render( <CommandsAdmin /> );
}

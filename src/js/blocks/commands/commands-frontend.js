/**
 * Frontend commands registration.
 */
import { createRoot } from 'react-dom/client';
import { registerPlugin } from '@wordpress/plugins';
import { useRefreshCSSFilesCommand } from './components/commands/RefreshCSSFiles';

/**
 * Commands frontend component.
 *
 * @return {JSX.Element|null} The CommandsFrontend component.
 */
const CommandsFrontend = () => {
	const refreshCSSFilesModal = useRefreshCSSFilesCommand();
	return refreshCSSFilesModal;
};

registerPlugin( 'mrshortcuts-gb-commands-frontend', {
	render: CommandsFrontend,
} );
const rootElement = document.getElementById( 'mrshortcuts-gb-commands-frontend' );
if ( rootElement ) {
	const root = createRoot( rootElement );
	root.render( <CommandsFrontend /> );
}

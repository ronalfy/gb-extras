import React from 'react';

import { createRoot } from 'react-dom/client';
import Main from './main';

const container = document.getElementById( 'mrshortcuts-gb' );
const root = createRoot( container );
root.render(
	<React.StrictMode>
		<Main />
	</React.StrictMode>
);

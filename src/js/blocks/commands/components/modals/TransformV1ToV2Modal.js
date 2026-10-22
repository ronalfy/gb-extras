/**
 * Modal for transforming v1 blocks to v2.
 */

import { Modal, Button, CheckboxControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import { useState } from 'react';

/**
 * TransformV1ToV2Modal component.
 *
 * @param {Object}   props            - Component props.
 * @param {boolean}  props.isOpen     - Boolean to control modal visibility.
 * @param {Function} props.onClose    - Callback when modal is closed.
 * @param {Function} props.onConfirm  - Callback when transformation is confirmed.
 * @param {boolean}  props.transforming - Boolean indicating transforming state.
 * @return {JSX.Element|null} The TransformV1ToV2Modal component.
 */
const TransformV1ToV2Modal = ( { isOpen, onClose, onConfirm, transforming } ) => {
	const [ confirmed, setConfirmed ] = useState( false );

	if ( ! isOpen ) {
		return null;
	}

	return (
		<Modal
			isDismissible={ ! transforming }
			shouldCloseOnClickOutside={ false }
			onRequestClose={ onClose }
			title={ __( 'Convert v1 Blocks to v2', 'mediaron-block-shortcuts-for-gb' ) }
		>
			<div style={ { marginBottom: '20px' } }>
				<p>{ __( 'Please back up your blocks before transforming. There is no undo for this operation.', 'mediaron-block-shortcuts-for-gb' ) }</p>
				<p>{ __( 'This will convert all v1 blocks to v2 blocks.', 'mediaron-block-shortcuts-for-gb' ) }</p>
			</div>
			<div style={ { marginBottom: '20px' } }>
				<CheckboxControl
					label={ __( 'I understand and want to proceed.', 'mediaron-block-shortcuts-for-gb' ) }
					checked={ confirmed }
					onChange={ setConfirmed }
					help={ __( 'Please back up your blocks before transforming. There is no undo for this operation.', 'mediaron-block-shortcuts-for-gb' ) }
				/>
			</div>
			<div style={ { display: 'flex', justifyContent: 'flex-end', gap: '10px' } }>
				<Button
					variant="primary"
					onClick={ onConfirm }
					disabled={ ! confirmed || transforming }
					isBusy={ transforming }
				>
					{ transforming ? __( 'Transforming…', 'mediaron-block-shortcuts-for-gb' ) : __( 'Transform', 'mediaron-block-shortcuts-for-gb' ) }
				</Button>
				<Button
					variant="secondary"
					onClick={ onClose }
					disabled={ transforming }
				>
					{ __( 'Cancel', 'mediaron-block-shortcuts-for-gb' ) }
				</Button>
			</div>
		</Modal>
	);
};

export default TransformV1ToV2Modal;

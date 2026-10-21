/**
 * Modal for transforming paragraph blocks to GB text blocks.
 */

import { Modal, Button } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

/**
 * TransformParagraphModal component.
 *
 * @param {Object}   props            - Component props.
 * @param {boolean}  props.isOpen     - Boolean to control modal visibility.
 * @param {Function} props.onClose    - Callback when modal is closed.
 * @param {Function} props.onConfirm  - Callback when transformation is confirmed.
 * @param {boolean}  props.transforming - Boolean indicating transforming state.
 * @param {number}   props.paragraphCount - Number of paragraph blocks found.
 * @return {JSX.Element|null} The TransformParagraphModal component.
 */
const TransformParagraphModal = ( { isOpen, onClose, onConfirm, transforming, paragraphCount } ) => {
	if ( ! isOpen ) {
		return null;
	}

	return (
		<Modal
			isDismissible={ ! transforming }
			shouldCloseOnClickOutside={ false }
			onRequestClose={ onClose }
			title={ __( 'Convert Paragraphs to GenerateBlocks Text Blocks', 'mediaron-block-shortcuts-for-gb' ) }
		>
			<div style={ { marginBottom: '20px' } }>
				<p>
					{ __( 'This will convert all core paragraph blocks to GenerateBlocks v2 text blocks.', 'mediaron-block-shortcuts-for-gb' ) }
				</p>
				{ paragraphCount > 0 && (
					<p>
						{ __( 'Found ', 'mediaron-block-shortcuts-for-gb' ) }
						<strong>{ paragraphCount }</strong>
						{ paragraphCount === 1
							? __( ' paragraph block to convert.', 'mediaron-block-shortcuts-for-gb' )
							: __( ' paragraph blocks to convert.', 'mediaron-block-shortcuts-for-gb' ) }
					</p>
				) }
				{ paragraphCount > 0 && (
					<p>
						{ __( 'Please back up your content before converting. There is no undo for this operation.', 'mediaron-block-shortcuts-for-gb' ) }
					</p>
				) }
				{ paragraphCount === 0 && (
					<p>
						{ __( 'No paragraph blocks found to convert.', 'mediaron-block-shortcuts-for-gb' ) }
					</p>
				) }
			</div>
			<div style={ { display: 'flex', justifyContent: 'flex-end', gap: '10px' } }>
				<Button
					variant="primary"
					onClick={ onConfirm }
					disabled={ transforming || paragraphCount === 0 }
					isBusy={ transforming }
				>
					{ transforming ? __( 'Converting…', 'mediaron-block-shortcuts-for-gb' ) : __( 'Convert Paragraphs', 'mediaron-block-shortcuts-for-gb' ) }
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

export default TransformParagraphModal;

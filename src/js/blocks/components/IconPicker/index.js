import './editor.scss';
import { __ } from '@wordpress/i18n';
import { renderToString, useState } from '@wordpress/element';
import {
	BaseControl,
	TextControl,
	Tooltip,
	Button,
	Popover,
} from '@wordpress/components';
import sanitizeSVG from '../../utils/sanitize-svg';

const IconPicker = (props) => {
	const [isCustomIcon, setIsCustomIcon] = useState(false);
	const [selectedIcon, setSelectedIcon] = useState(props.defaultSvg);
	const [isPopoverVisible, setIsPopOverVisible] = useState(false);
	const [isFocusedOutside, setIsFocusedOutside] = useState(false);

	const { defaultSvg, setAttributes, icons } = props;

	/**
	 * Retrieve popover content for custom icons or regular icons.
	 *
	 * @return {string} Popover content.
	 */
	const getPopoverContent = () => {
		if (!isCustomIcon) {
			return (
				<>
					<ul className="gb-extras-icon-list">
						{Object.keys(icons).map((svg, i) => {
							return (
								<li key={`gb-extras-icon-${i}`}>
									<Tooltip text={icons[svg].label}>
										<Button
											className="editor-block-list-item-button"
											onClick={() => {
												setAttributes({
													icon: renderToString(icons[svg].icon),
												});
											}}
										>
											<span className="editor-block-types-list__item-icon">
												{icons[svg].icon}
											</span>
										</Button>
									</Tooltip>
								</li>
							);
						})}
					</ul>
					<Button
						className="gb-extras-custom-icon-button"
						variant="secondary"
						showTooltip={true}
						label={__(
							'Add in a custom SVG instead of selecting an icon.',
							'gb-extras'
						)}
						onClick={() => {
							setIsCustomIcon(true);
						}}
					>
						{__('Set a Custom Icon', 'gb-extras')}
					</Button>
				</>
			);
		}
		// Return custom icon interface.
		return (
			<>
				<div className="gb-extras-custom-icon-preview">
					<span
						dangerouslySetInnerHTML={{ __html: sanitizeSVG(selectedIcon) }}
					/>
				</div>
				<div className="gb-extras-custom-icon-input">
					<TextControl
						label={__('SVG Code', 'gb-extras')}
						value={sanitizeSVG(selectedIcon)}
						onChange={(value) => {
							setSelectedIcon(value);
						}}
					/>
					<Button
						isPrimary
						onClick={() => {
							setAttributes({
								icon: sanitizeSVG(selectedIcon),
							});
							setSelectedIcon(selectedIcon);
						}}
					>
						{__('Set Icon', 'gb-extras')}
					</Button>
					<Button
						variant="tertiary"
						onClick={() => {
							setIsCustomIcon(false);
						}}
					>
						{__('Back to Icons', 'gb-extras')}
					</Button>
				</div>
			</>
		);
	};

	const toggleVisible = () => {
		setIsPopOverVisible((state) => !state);
	};

	return (
		<>
			<BaseControl className="gb-extras-icon-wrapper">
				<div className="gb-extras-icon-preview">
					<Button
						className="button-reset gb-extras-icon-preview-button"
						onClick={(e) => {
							if (isFocusedOutside) {
								setIsFocusedOutside(false);
								return;
							}
							toggleVisible();
						}}
					>
						<span dangerouslySetInnerHTML={{ __html: sanitizeSVG(defaultSvg) }} />
					</Button>
				</div>
			</BaseControl>
			{isPopoverVisible && (
				<Popover noArrow={false} className="gb-extras-icon-popover" onFocusOutside={() => {
					setIsFocusedOutside(true);
					setIsPopOverVisible(false);
				}}>
					<BaseControl className="gb-extras-icon-picker">
						<h2>{__('Select an Icon', 'gb-extras')}</h2>
						{getPopoverContent()}
					</BaseControl>
				</Popover>
			)}
		</>
	);
};
export default IconPicker;

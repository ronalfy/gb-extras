<?php
/**
 * Admin Bar class.
 *
 * @package MRShortcutsGB
 */

namespace MRShortcutsGB;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct access.' );
}

/**
 * Class that handles admin bar menu modifications.
 */
class Admin_Bar {

	/**
	 * Class runner.
	 */
	public function run() {
		// Only run if GenerateBlocks Pro is active (this feature is Pro-only).
		if ( ! Functions::is_generateblocks_pro_active() ) {
			return;
		}

		// Use priority 101 to run after GenerateBlocks Pro adds its items (which uses priority 100).
		add_action( 'admin_bar_menu', array( $this, 'modify_admin_bar_items' ), 101 );
	}

	/**
	 * Whether the current user may receive admin bar changes (hide menu or full menu replacement).
	 *
	 * @return bool True when the user is an administrator or editor.
	 */
	private function current_user_can_use_admin_bar_customizations() {
		if ( is_multisite() && is_super_admin() ) {
			return true;
		}

		return current_user_can( 'manage_options' );
	}

	/**
	 * Modify admin bar items based on options.
	 *
	 * @param \WP_Admin_Bar $admin_bar The admin bar object.
	 */
	public function modify_admin_bar_items( $admin_bar ) {
		if ( ! $this->current_user_can_use_admin_bar_customizations() ) {
			return;
		}

		wp_register_style(
			'mrshortcuts-gb-admin-bar',
			null,
			array(),
			'1.0.0',
			'all'
		);
		wp_add_inline_style(
			'mrshortcuts-gb-admin-bar',
			'#wp-admin-bar-generateblocks-menu > .ab-item:before {
				content: "\f111";
				background-color: transparent;
				-webkit-mask-image: none;
				mask-image: none;
				font-family: generatepress-admin, dashicons, sans-serif;
				font-size: 18px;
				line-height: 100%;
				margin-top: 2px;
				color: #f0f0f1;
			}'
		);
		wp_enqueue_style( 'mrshortcuts-gb-admin-bar' );

		$options                = Options::get_options();
		$admin_menu_bar         = $options['adminMenuBar'] ?? array();
		$enabled                = (bool) ( $admin_menu_bar['enabled'] ?? true );
		$replace_with_full_menu = (bool) ( $admin_menu_bar['replaceWithFullMenu'] ?? false );

		// If admin menu bar is disabled, remove all GenerateBlocks items.
		if ( ! $enabled ) {
			$this->remove_all_generateblocks_items( $admin_bar );
			return; // Exit early if disabled.
		}

		// If replace with full menu is enabled, remove Overlay Panels and add full menu.
		if ( $replace_with_full_menu ) {
			// Remove the Overlay Panels menu (confirmed ID: gb_overlays-menu).
			// Note: We're already in a Pro-only context (checked in run()).
			$admin_bar->remove_node( 'gb_overlays-menu' );

			// Add full GenerateBlocks menu with all sub-items.
			$this->add_full_generateblocks_menu( $admin_bar );
		}
	}

	/**
	 * Remove all GenerateBlocks admin bar items.
	 *
	 * @param \WP_Admin_Bar $admin_bar The admin bar object.
	 */
	private function remove_all_generateblocks_items( $admin_bar ) {
		// Remove known GenerateBlocks Pro items.
		// Note: We're already in a Pro-only context (checked in run()).
		$admin_bar->remove_node( 'gb_overlays-menu' );

		// Remove our custom full menu if it exists.
		$admin_bar->remove_node( 'generateblocks-menu' );

		// TODO: Add removal for other GenerateBlocks items as they are identified.
		// Common pattern: inspect admin bar HTML to find node IDs.
	}

	/**
	 * Add full GenerateBlocks admin bar menu with all sub-items.
	 *
	 * @param \WP_Admin_Bar $admin_bar The admin bar object.
	 */
	private function add_full_generateblocks_menu( $admin_bar ) {
		// Check if menu already exists to avoid duplicates.
		$existing_node = $admin_bar->get_node( 'generateblocks-menu' );
		if ( $existing_node ) {
			return;
		}

		if ( ! is_admin() && class_exists( '\GenerateBlocks_Pro_Design_Menu' ) ) {
			$menu_font_url = GENERATEBLOCKS_PRO_DIR_URL . 'dist/assets/fonts/generatepress-admin.woff2';

			wp_register_style(
				'mrshortcuts-gb-admin-bar-font',
				null,
				array(),
				'1.0.0',
				'all'
			);
			wp_add_inline_style(
				'mrshortcuts-gb-admin-bar-font',
				'@font-face {
					font-family: generatepress-admin;
					src: url("' . esc_url( $menu_font_url ) . '") format("woff2");
					font-weight: 400;
					font-style: normal;
					font-display: block;
				}'
			);
			wp_enqueue_style( 'mrshortcuts-gb-admin-bar-font' );
		}

		// Add main GenerateBlocks menu item.
		$admin_bar->add_menu(
			array(
				'id'    => 'generateblocks-menu',
				'title' => esc_html__( 'GenerateBlocks', 'mediaron-block-shortcuts-for-gb' ),
				'href'  => admin_url( 'admin.php?page=generateblocks-settings' ),
			)
		);

		$admin_bar->add_node(
			array(
				'parent' => 'generateblocks-menu',
				'id'     => 'generateblocks-settings-group',
				'title'  => esc_html__( 'Settings', 'mediaron-block-shortcuts-for-gb' ),
				'href'   => admin_url( 'admin.php?page=generateblocks-settings' ),
			)
		);

		// Add Settings submenu (available in free version).
		$admin_bar->add_node(
			array(
				'parent' => 'generateblocks-settings-group',
				'id'     => 'generateblocks-settings-item',
				'title'  => __( 'Settings', 'mediaron-block-shortcuts-for-gb' ),
				'href'   => admin_url( 'admin.php?page=generateblocks-settings' ),
			)
		);

		// Add Pro items (redundant check but kept for safety - we're already in Pro context).
		if ( Functions::is_generateblocks_pro_active() ) {
			// Add Editor Access only if available in GenerateBlocks Pro.
			if ( function_exists( 'generateblocks_pro_editor_access_enabled' ) && \generateblocks_pro_editor_access_enabled() ) {
				$admin_bar->add_node(
					array(
						'parent' => 'generateblocks-settings-group',
						'id'     => 'generateblocks-editor-access',
						'title'  => __( 'Editor Access', 'mediaron-block-shortcuts-for-gb' ),
						'href'   => admin_url( 'admin.php?page=generateblocks-editor-access' ),
					)
				);
			}
			$admin_bar->add_node(
				array(
					'parent' => 'generateblocks-menu',
					'id'     => 'generateblocks-design-group',
					'title'  => __( 'Design', 'mediaron-block-shortcuts-for-gb' ),
				)
			);
			// Get GenerateBlocks design settings.
			$admin_bar->add_node(
				array(
					'parent' => 'generateblocks-design-group',
					'id'     => 'generateblocks-global-styles-item',
					'title'  => __( 'Global Styles', 'mediaron-block-shortcuts-for-gb' ),
					'href'   => admin_url( 'admin.php?page=generateblocks-styles' ),
				)
			);
			$admin_bar->add_node(
				array(
					'parent' => 'generateblocks-design-group',
					'id'     => 'generateblocks-design-tokens-item',
					'title'  => __( 'Design Tokens', 'mediaron-block-shortcuts-for-gb' ),
					'href'   => admin_url( 'admin.php?page=generateblocks-styles&view=design-tokens' ),
				)
			);

			$admin_bar->add_node(
				array(
					'parent' => 'generateblocks-menu',
					'id'     => 'generateblocks-build-group',
					'title'  => __( 'Build', 'mediaron-block-shortcuts-for-gb' ),
				)
			);

			// Defaults: enable_overlay_panels and enable_block_conditions both default to true.
			$gb_options = get_option( 'generateblocks', array() );

			// Check if overlay panels and conditions are enabled (default to true if not set).
			$overlay_panels_enabled = isset( $gb_options['enable_overlay_panels'] ) ? (bool) $gb_options['enable_overlay_panels'] : true;
			$conditions_enabled     = isset( $gb_options['enable_block_conditions'] ) ? (bool) $gb_options['enable_block_conditions'] : true;

			// Add Local Patterns.
			$admin_bar->add_node(
				array(
					'parent' => 'generateblocks-build-group',
					'id'     => 'generateblocks-local-patterns-item',
					'title'  => __( 'Local Patterns', 'mediaron-block-shortcuts-for-gb' ),
					'href'   => admin_url( 'edit.php?post_type=wp_block' ),
				)
			);

			// Add Asset Library.
			$admin_bar->add_node(
				array(
					'parent' => 'generateblocks-build-group',
					'id'     => 'generateblocks-asset-library-item',
					'title'  => __( 'Asset Library', 'mediaron-block-shortcuts-for-gb' ),
					'href'   => admin_url( 'admin.php?page=generateblocks-asset-library' ),
				)
			);

			// Add Forms only if enabled in GenerateBlocks Pro.
			if ( function_exists( 'generateblocks_pro_forms_enabled' ) && \generateblocks_pro_forms_enabled() ) {
				$admin_bar->add_node(
					array(
						'parent' => 'generateblocks-build-group',
						'id'     => 'generateblocks-forms',
						'title'  => __( 'Forms', 'mediaron-block-shortcuts-for-gb' ),
						'href'   => admin_url( 'admin.php?page=generateblocks-forms' ),
					)
				);
			}

			// Add Overlay Panels only if enabled in GenerateBlocks settings.
			if ( $overlay_panels_enabled ) {
				$admin_bar->add_node(
					array(
						'parent' => 'generateblocks-build-group',
						'id'     => 'generateblocks-overlay-panels',
						'title'  => __( 'Overlay Panels', 'mediaron-block-shortcuts-for-gb' ),
						'href'   => admin_url( 'admin.php?page=generateblocks-overlay-panels' ),
					)
				);
			}

			// Add Conditions only if enabled in GenerateBlocks settings.
			if ( $conditions_enabled ) {
				$admin_bar->add_node(
					array(
						'parent' => 'generateblocks-build-group',
						'id'     => 'generateblocks-conditions',
						'title'  => __( 'Conditions', 'mediaron-block-shortcuts-for-gb' ),
						'href'   => admin_url( 'admin.php?page=generateblocks-conditions' ),
					)
				);
			}
		}

		// Add Shortcuts last.
		$admin_bar->add_node(
			array(
				'parent' => 'generateblocks-settings-group',
				'id'     => 'mr-shortcuts-item',
				'title'  => __( 'Shortcuts', 'mediaron-block-shortcuts-for-gb' ),
				'href'   => admin_url( 'admin.php?page=mrshortcuts-gb' ),
			)
		);
	}
}

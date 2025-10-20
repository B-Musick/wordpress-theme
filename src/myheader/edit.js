import { __ } from "@wordpress/i18n";
import { useBlockProps, InspectorControls } from "@wordpress/block-editor";
import { PanelBody, TextControl } from "@wordpress/components";
import { Fragment } from "@wordpress/element";

export default function Edit({ attributes, setAttributes }) {
	const { topMenuFull, topMenuMobile, mainMenu } = attributes;

	return (
		<Fragment>
			<InspectorControls>
				<PanelBody
					title={__("Header Menu Settings", "myheader")}
					initialOpen={true}
				>
					<TextControl
						label={__("Top Menu (Full)", "myheader")}
						value={topMenuFull}
						onChange={(value) => setAttributes({ topMenuFull: value })}
						placeholder="e.g. top-menu-full"
					/>
					<TextControl
						label={__("Top Menu (Mobile)", "myheader")}
						value={topMenuMobile}
						onChange={(value) => setAttributes({ topMenuMobile: value })}
						placeholder="e.g. top-menu-mobile"
					/>
					<TextControl
						label={__("Main Menu", "myheader")}
						value={mainMenu}
						onChange={(value) => setAttributes({ mainMenu: value })}
						placeholder="e.g. main-menu"
					/>
				</PanelBody>
			</InspectorControls>

			<p {...useBlockProps()}>
				{__("My Header Block", "myheader")}
				<br />
				<small>
					Top Menu (Full): {topMenuFull || "—"}
					<br />
					Top Menu (Mobile): {topMenuMobile || "—"}
					<br />
					Main Menu: {mainMenu || "—"}
				</small>
			</p>
		</Fragment>
	);
}

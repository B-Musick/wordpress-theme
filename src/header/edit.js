import { __ } from "@wordpress/i18n";
import {
	useBlockProps,
	InspectorControls,
	MediaPlaceholder,
} from "@wordpress/block-editor";
import { PanelBody, TextControl, ColorPicker } from "@wordpress/components";
import { Fragment } from "@wordpress/element";

export default function Edit({ attributes, setAttributes }) {
	const {
		topMenuFull,
		topMenuMobile,
		mainMenu,
		toolbarColor,
		navbarColor,
		toolbarTextColor,
		navbarTextColor,
		image_id,
		image_url,
	} = attributes;
	// const [toolbarColor, setToolbarColor] = useState();
	// const [navbarColor, setNavbarColor] = useState();

	return (
		<Fragment>
			<InspectorControls>
				<PanelBody
					title={__("Header Menu Settings", "ucn-theme")}
					initialOpen={true}
				>
					<TextControl
						label={__("Top Menu (Full)", "ucn-theme")}
						value={topMenuFull}
						onChange={(value) => setAttributes({ topMenuFull: value })}
						placeholder="e.g. top-menu-full"
					/>
					<TextControl
						label={__("Top Menu (Mobile)", "ucn-theme")}
						value={topMenuMobile}
						onChange={(value) => setAttributes({ topMenuMobile: value })}
						placeholder="e.g. top-menu-mobile"
					/>
					<TextControl
						label={__("Main Menu", "ucn-theme")}
						value={mainMenu}
						onChange={(value) => setAttributes({ mainMenu: value })}
						placeholder="e.g. main-menu"
					/>
				</PanelBody>

				<PanelBody
					title={__("Color Settings", "ucn-theme")}
					initialOpen={false}
				>
					<p>Toolbar Color</p>
					<ColorPicker
						color={toolbarColor}
						title="Toolbar Color"
						onChange={(value) => setAttributes({ toolbarColor: value })}
						enableAlpha
						defaultValue="#f5f5f5"
					/>

					<p>Navbar Color</p>
					<ColorPicker
						color={navbarColor}
						title="Navbar Color"
						onChange={(value) => setAttributes({ navbarColor: value })}
						enableAlpha
						defaultValue="#006DB7"
					/>

					<p>Toolbar Text Color</p>
					<ColorPicker
						color={toolbarTextColor}
						title="Toolbar Text Color"
						onChange={(value) => setAttributes({ toolbarTextColor: value })}
						enableAlpha
						defaultValue="#444"
					/>

					<p>Navbar Text Color</p>

					<ColorPicker
						color={navbarTextColor}
						title="Navbar Text Color"
						onChange={(value) => setAttributes({ navbarTextColor: value })}
						enableAlpha
						defaultValue="white"
					/>
				</PanelBody>
				<PanelBody
					title={__("Color Settings", "ucn-theme")}
					initialOpen={false}
				>
					{attributes.image_url && attributes.image_id ? (
						<>
							<img src={attributes.image_url} />
							<button
								className="button-remove"
								onClick={() => setAttributes({ image_url: "", image_id: null })}
							>
								Remove
							</button>
						</>
					) : (
						<MediaPlaceholder
							onSelect={(image) => {
								setAttributes({ image_url: image.url, image_id: image.id });
							}}
							allowedTypes={["image"]}
							multiple={false}
							labels={{ title: "CTA Image" }}
						></MediaPlaceholder>
					)}
				</PanelBody>
			</InspectorControls>

			<p {...useBlockProps()}>
				{__("My Header Block", "ucn-theme")}
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

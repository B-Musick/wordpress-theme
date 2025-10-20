import { __ } from "@wordpress/i18n";
import { useBlockProps, InspectorControls } from "@wordpress/block-editor";
import { PanelBody, TextControl, Button } from "@wordpress/components";
import { Fragment } from "@wordpress/element";

export default function Edit({ attributes, setAttributes }) {
	const { menus = [] } = attributes;

	const updateMenu = (index, field, value) => {
		const newMenus = [...menus];
		newMenus[index][field] = value;
		setAttributes({ menus: newMenus });
	};

	const addMenu = () => {
		setAttributes({
			menus: [...menus, { label: "New Menu", themeLocation: "" }],
		});
	};

	const removeMenu = (index) => {
		const newMenus = [...menus];
		newMenus.splice(index, 1);
		setAttributes({ menus: newMenus });
	};

	return (
		<Fragment>
			<InspectorControls>
				<PanelBody title={__("Footer Menus", "ucn-theme")} initialOpen={true}>
					{menus.map((menu, index) => (
						<div
							key={index}
							style={{
								borderBottom: "1px solid #ddd",
								paddingBottom: "10px",
								marginBottom: "10px",
							}}
						>
							<TextControl
								label={__("Menu Label", "ucn-theme")}
								value={menu.label}
								onChange={(value) => updateMenu(index, "label", value)}
							/>
							<TextControl
								label={__("Theme Location", "ucn-theme")}
								value={menu.themeLocation}
								onChange={(value) => updateMenu(index, "themeLocation", value)}
								placeholder="e.g. footer-admissions"
							/>
							<Button
								isDestructive
								isSecondary
								onClick={() => removeMenu(index)}
							>
								{__("Remove Menu", "ucn-theme")}
							</Button>
						</div>
					))}

					<Button isPrimary onClick={addMenu}>
						{__("Add Menu", "ucn-theme")}
					</Button>
				</PanelBody>
			</InspectorControls>

			<div {...useBlockProps()}>
				<p>
					<strong>{__("Footer Preview", "ucn-theme")}</strong>
				</p>
				<ul>
					{menus.map((menu, index) => (
						<li key={index}>
							{menu.label} (
							{menu.themeLocation || __("no location", "ucn-theme")})
						</li>
					))}
				</ul>
			</div>
		</Fragment>
	);
}

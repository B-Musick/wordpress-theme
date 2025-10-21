import { __ } from "@wordpress/i18n";
import { useBlockProps, InspectorControls } from "@wordpress/block-editor";
import { PanelBody, TextControl, Button } from "@wordpress/components";
import { Fragment } from "@wordpress/element";

export default function Edit({ attributes, setAttributes }) {
	const { menus = [], policies = [] } = attributes;

	// --- Menus (you already had these) ---
	const updateMenu = (index, field, value) => {
		const next = [...menus];
		next[index][field] = value;
		setAttributes({ menus: next });
	};
	const addMenu = () =>
		setAttributes({
			menus: [...menus, { label: "New Menu", themeLocation: "" }],
		});
	const removeMenu = (index) => {
		const next = [...menus];
		next.splice(index, 1);
		setAttributes({ menus: next });
	};

	// --- Policies (NEW) ---
	const updatePolicy = (index, field, value) => {
		const next = [...policies];
		next[index][field] = value;
		setAttributes({ policies: next });
	};
	const addPolicy = () => {
		setAttributes({ policies: [...policies, { text: "", url: "" }] });
	};
	const removePolicy = (index) => {
		const next = [...policies];
		next.splice(index, 1);
		setAttributes({ policies: next });
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
								paddingBottom: 10,
								marginBottom: 10,
							}}
						>
							<TextControl
								label={__("Menu Label", "ucn-theme")}
								value={menu.label}
								onChange={(v) => updateMenu(index, "label", v)}
							/>
							<TextControl
								label={__("Theme Location", "ucn-theme")}
								value={menu.themeLocation}
								onChange={(v) => updateMenu(index, "themeLocation", v)}
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

				{/* NEW: Footer Policies panel */}
				<PanelBody
					title={__("Footer Policies", "ucn-theme")}
					initialOpen={false}
				>
					{policies.map((policy, index) => (
						<div
							key={index}
							style={{
								borderBottom: "1px solid #ddd",
								paddingBottom: 10,
								marginBottom: 10,
							}}
						>
							<TextControl
								label={__("Link Text", "ucn-theme")}
								value={policy.text}
								onChange={(v) => updatePolicy(index, "text", v)}
								placeholder="Privacy Policy"
							/>
							<TextControl
								label={__("URL", "ucn-theme")}
								value={policy.url}
								onChange={(v) => updatePolicy(index, "url", v)}
								placeholder="/privacy-policy"
							/>
							<Button
								isDestructive
								isSecondary
								onClick={() => removePolicy(index)}
							>
								{__("Remove Link", "ucn-theme")}
							</Button>
						</div>
					))}
					<Button isPrimary onClick={addPolicy}>
						{__("Add Link", "ucn-theme")}
					</Button>
				</PanelBody>
			</InspectorControls>

			<div {...useBlockProps()}>
				<p>
					<strong>{__("Footer Preview", "ucn-theme")}</strong>
				</p>
				<ul>
					{policies.map((p, i) => (
						<li key={i}>
							{p.text || "—"} {p.url && <small>({p.url})</small>}
						</li>
					))}
				</ul>
			</div>
		</Fragment>
	);
}

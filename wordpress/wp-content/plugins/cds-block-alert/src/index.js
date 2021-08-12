// https://wet-boew.github.io/wet-boew/docs/ref/collapsible-alerts/collapsible-alerts-en.html
import { __ } from "@wordpress/i18n";
import { registerBlockType } from "@wordpress/blocks";
import {
  useBlockProps,
  RichText,
  InspectorControls,
} from "@wordpress/block-editor";

import { PanelBody, PanelRow, SelectControl } from "@wordpress/components";

const AlertSettings = ({ alertType, setAttributes }) => (
  <InspectorControls>
    <PanelBody title="Settings" initialOpen={true}>
      <PanelRow>
        <PanelRow>
          <SelectControl
            label="Alert Type"
            value={alertType}
            options={[
              { label: "Info", value: "alert-info" },
              { label: "Success", value: "alert-success" },
              { label: "Warning", value: "alert-warning" },
              { label: "Danger", value: "alert-danger" },
            ]}
            onChange={(newval) => setAttributes({ alertType: newval })}
          />
        </PanelRow>
      </PanelRow>
    </PanelBody>
  </InspectorControls>
);

registerBlockType("cds-snc/alert", {
  title: __("Alert", "cds-snc-alert"),
  icon: "info-outline",
  category: "layout",
  example: {},
  attributes: {
    content: {
      type: "string",
      source: "html",
      selector: "p",
    },
    title: {
      type: "string",
      source: "html",
      selector: "h3",
    },
    alertType: {
      type: "string",
      default: "alert-info",
    },
  },

  edit({ attributes, setAttributes }) {
    return (
      <>
        <AlertSettings
          alertType={attributes.alertType}
          setAttributes={setAttributes}
        />
        <div className={`alert ${attributes.alertType}`}>
          <div>
            <RichText
              tagName="h3" // The tag here is the element output and editable in the admin
              value={attributes.title} // Any existing content, either from the database or an attribute default
              allowedFormats={[]} // Allow the content to be made bold or italic, but do not allow other formatting options
              onChange={(title) => setAttributes({ title })} // Store updated content as a block attribute
              placeholder={__("Title")} // Display this text before any content has been added by the user
            />
            <RichText
              tagName="p" // The tag here is the element output and editable in the admin
              value={attributes.content} // Any existing content, either from the database or an attribute default
              // allowedFormats={["core/bold", "core/italic", "core/list"]} // Allow the content to be made bold or italic, but do not allow other formatting options
              onChange={(content) => setAttributes({ content })} // Store updated content as a block attribute
              placeholder={__("Summary")} // Display this text before any content has been added by the user
            />
          </div>
        </div>
      </>
    );
  },

  save({ attributes }) {
    const blockProps = useBlockProps.save();

    return (
      <section>
        <details class={`alert ${attributes.alertType}`} open="open">
          <summary class="h3">
            <h3>{attributes.title}</h3>
          </summary>
          <RichText.Content
            {...blockProps}
            tagName="p"
            value={attributes.content}
          />
        </details>
      </section>
    );
  },
});

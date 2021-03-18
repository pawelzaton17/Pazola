/*global wp*/
const { InnerBlocks, InspectorControls, PanelColorSettings } = wp.blockEditor;
const { registerBlockType } = wp.blocks;
const { PanelBody, ToggleControl, SelectControl } = wp.components;
const { select } = wp.data;
const { getColorClassName, getColorObjectByColorValue } = wp.editor;
const { __ } = wp.i18n;

const generateClass = attributes => {
	const { spacingTop, spacingBottom, marginTop, marginBottom, backgroundColor } = attributes;
    let customClass = 'block-content ';
    if( backgroundColor ) {
        const settings = select( 'core/editor' ).getEditorSettings();
        const colorObject = getColorObjectByColorValue( settings.colors, backgroundColor );
        if ( colorObject ) {
            customClass += getColorClassName( 'background-color', colorObject.slug );
        }
    }

    customClass += spacingTop ? ' block-content--spacing-top' : '';
    customClass += spacingBottom ? ' block-content--spacing-bottom' : '';
    customClass += marginTop ? ' block-content--margin-top' : '';
    customClass += marginBottom ? ' block-content--margin-bottom' : '';

	return customClass;
}

const generateAttr = attributes => {
    const { backgroundColor } = attributes;
    const attrObj = {};

    if (backgroundColor) {
        attrObj.style = {};
        attrObj.style.backgroundColor = backgroundColor;
    }

    return attrObj;
}

const generateStructure = (attributes, admin) => {
    const { container, containerWidth } = attributes;
    const containerClass = `container container--${containerWidth}`;
    let html;
    if ( admin ) {
        html = container ? <div className={ containerClass }><div className="container__body"><InnerBlocks /></div></div> : <InnerBlocks />;
    } else {
        html = container ? <div className={ containerClass }><div className="container__body"><InnerBlocks.Content /></div></div> : <InnerBlocks.Content />;
    }
    return html;
}

registerBlockType( 'custom/section', {
    title: 'Section',
    icon: 'welcome-add-page',
    category: 'custom_blocks',
    supports: {
        align: [ 'full' ],
    },
    attributes: {
        backgroundColor: {
            type: 'string'
        },
        align: {
            type: 'string',
            default: 'full'
        },
        containerWidth: {
            type: 'string',
            default: 'full'
        },
        container: {
			type: 'boolean',
			default: false
        },
		spacingTop: {
			type: 'boolean',
			default: false
        },
		spacingBottom: {
			type: 'boolean',
			default: false
        },
		marginTop: {
			type: 'boolean',
			default: false
        },
		marginBottom: {
			type: 'boolean',
			default: false
        },
    },
    edit: ( { attributes, setAttributes } ) => {
        const { containerWidth, container, spacingTop, spacingBottom, marginTop, marginBottom, backgroundColor } = attributes;

        const selectContainer =
            <SelectControl
            label={ __( 'Container Width' ) }
            value={ containerWidth }
            options={ [
                { label: 'wide', value: 'wide' },
                { label: 'full', value: 'full' },
            ] }
            onChange={ (value) =>
                            setAttributes( { containerWidth: value } )
                        }
            />
        const adminPanel =
            <InspectorControls>
                <PanelBody title={ __( 'Settings' ) }>
                    <ToggleControl
                        label={ __( 'Container' ) }
                        checked={ !! container }
                        onChange={ () =>
                            setAttributes( { container: ! container } )
                        }
                        help={
                            container
                                ? 'Adding Container'
                                : 'Toggle to add Container.'
                        }
                    />
                    {container ? selectContainer : ''}
                    <ToggleControl
                        label={ __( 'Top Spacing' ) }
                        checked={ !! spacingTop }
                        onChange={ () =>
                            setAttributes( { spacingTop: ! spacingTop } )
                        }
                        help={
                            spacingTop
                                ? 'Adding Top spacing'
                                : 'Toggle to add Top spacing.'
                        }
                    />
                    <ToggleControl
                        label={ __( 'Bottom Spacing' ) }
                        checked={ !! spacingBottom }
                        onChange={ () =>
                            setAttributes( { spacingBottom: ! spacingBottom } )
                        }
                        help={
                            spacingBottom
                                ? 'Adding Bottom spacing'
                                : 'Toggle to add Bottom spacing.'
                        }
                    />
                    <ToggleControl
                        label= { __( 'Top margin' ) }
                        checked={ !! marginTop }
                        onChange={ () =>
                            setAttributes( { marginTop: ! marginTop } )
                        }
                        help={
                            marginTop
                                ? 'Adding Top margin'
                                : 'Toggle to add Top margin.'
                        }
                    />
                    <ToggleControl
                        label={ __( 'Bottom margin' ) }
                        checked={ !! marginBottom }
                        onChange={ () =>
                            setAttributes( { marginBottom: ! marginBottom } )
                        }
                        help={
                            marginBottom
                                ? 'Adding Bottom margin'
                                : 'Toggle to add Bottom margin.'
                        }
                    />
                </PanelBody>
                <PanelColorSettings
                    title={ __( 'Color Settings' ) }
                    colorSettings={ [
                        {
                            value: backgroundColor,
                            onChange: ( colorValue ) => setAttributes( { backgroundColor: colorValue } ),
                            label: __( 'Background Color' ),
                        },
                    ] }
                />
            </InspectorControls>
        return (
            <>
                {adminPanel}
                <section className={ generateClass(attributes) } {...generateAttr(attributes)}>
                    { generateStructure(attributes, true) }
                </section>
            </>
        );
    },
    save: ( { attributes } ) => {
        return (
            <section className={ generateClass(attributes) }>
                <div data-styles-id="custom-container" />
                { generateStructure(attributes, false) }
            </section>
        );
    },
} );
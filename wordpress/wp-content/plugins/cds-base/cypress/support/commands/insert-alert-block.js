Cypress.Commands.add('insertAlertBlock', () => {
    cy.searchForBlock('Alert');
    cy.get(
        'button.editor-block-list-item-cds-snc-blocks-button'
    ).click({ force: true });
});
describe('Login', () =>{
    it('Successful Login', () => {
        //visit the URL
        cy.visit('http://localhost/Cypress/login.php')
        //input user name + password (valid)
        cy.get('input[name=userName').type("user")
        cy.get('input[name=password').type("1234")
        //click the submit button
        cy.get('button').contains('Submit').click()
        //assert that we are at the correct URL
        cy.url().should('contain', 'http://localhost/Cypress/secret.php')
    })
})
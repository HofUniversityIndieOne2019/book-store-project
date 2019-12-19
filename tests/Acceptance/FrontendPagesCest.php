<?php namespace OliverHader\BookStoreProject\Tests\Acceptance\Support;
use OliverHader\BookStoreProject\Tests\Acceptance\Support\AcceptanceTester;

class FrontendPagesCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function areImportantLinksAvailableInNavigation(AcceptanceTester $I, AdminTest $Admin)
    {
        $I->amOnPage('/');
        $I->canSee('Company', 'nav#mainnavigation');
        $I->cantSee('Logout', 'nav#mainnavigation');
    }

    public function ICanLoginAndLogoutAgain(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->canSee('My Book Store', 'nav#mainnavigation');
        $I->click('My Book Store', 'nav#mainnavigation');
        $I->canSee('User login');
        $I->fillField('user', 'user-001');
        $I->fillField('pass', 'password');
        $I->click('input[type=submit]');
        $I->canSee('You are now logged in as \'user-001\'');
        $I->makeScreenshot('logged-in');
    }
}

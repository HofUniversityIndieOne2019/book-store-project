<?php
namespace OliverHader\BookStoreProject\Tests\Acceptance\Support;
use OliverHader\BookStoreProject\Tests\Acceptance\Support\AcceptanceTester;

class FrontendPagesCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function areImportantLinksAvailableInMainNavigation(AcceptanceTester $I)
    {
        $I->wantToTest('Main navigation is correct');
        $I->amOnPage('/');
        $I->canSee('Company', 'nav#mainnavigation');
        $I->canSee('Legal Information', 'nav#mainnavigation');
    }

    public function user001CanLoginAndLogoutAgain(AcceptanceTester $I)
    {
        $I->wantToTest('Frontend loging and logout capabilities using user-001');
        $I->amOnPage('/');
        $I->canSee('My Book Store', 'nav#mainnavigation');
        $I->click('My Book Store', 'nav#mainnavigation');

        $I->canSee('User login', 'main');
        $I->cantSee('Logout', 'nav#mainnavigation');
        $I->fillField('user', 'user-001');
        $I->fillField('pass', 'password');
        $I->click('input[type=submit]', 'form');

        $I->canSee('You are now logged in as \'user-001\'', 'main');
        $I->canSee('Logout', 'nav#mainnavigation');
        $I->makeScreenshot('test_user-001_logged-in');

        $I->click('Logout', 'nav#mainnavigation');
        $I->cantSee('Logout', 'nav#mainnavigation');
    }
}

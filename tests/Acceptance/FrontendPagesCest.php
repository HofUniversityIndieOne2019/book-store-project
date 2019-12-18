<?php namespace OliverHader\BookStoreProject\Tests\Acceptance\Support;
use OliverHader\BookStoreProject\Tests\Acceptance\Support\AcceptanceTester;

class FrontendPagesCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->see('Company', 'nav#mainnavigation');
        $I->see('Books', 'nav#mainnavigation');
        $I->dontSee('Logout', 'nav#mainnavigation');
        $I->makeScreenshot('navigation');
    }
}

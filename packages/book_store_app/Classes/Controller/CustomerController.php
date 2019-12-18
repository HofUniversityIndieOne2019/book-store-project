<?php
namespace OliverHader\BookStoreApp\Controller;

use OliverHader\BookStoreApp\Domain\Model\Address;
use OliverHader\BookStoreApp\Domain\Model\BankAccount;
use OliverHader\BookStoreApp\Domain\Model\Customer;
use OliverHader\BookStoreApp\Domain\Model\PermissionException;
use OliverHader\SessionService\SubjectResolver;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3\CMS\Extbase\Persistence\Repository;

/***
 * This file is part of the "Book Store App" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2019 Oliver Hader <oliver.hader.2@hof-university.de>
 ***/

class CustomerController extends ActionController
{
    /**
     * @var Customer
     */
    private $customer;

    /**
     * @var PersistenceManager
     */
    private $persistenceManager;

    /**
     * Injecting TYPO3's persistence manger. We just need it to add
     * or update entities (which works with persistence manager. We
     * probably never have to apply customer queries - all data is
     * available in Customer entity (as aggregate root) already.
     *
     * @param PersistenceManager $persistenceManager
     *
     * @see Repository::add(), PersistenceManager::add()
     * @see Repository::update(), PersistenceManager::update()
     * @see Repository::remove(), PersistenceManager::remove()
     */
    public function injectPersistenceManager(PersistenceManager $persistenceManager)
    {
        $this->persistenceManager = $persistenceManager;
    }

    /**
     * Execute before every action of this controller.
     * Use to retrieve current logged in Customer object.
     */
    protected function initializeAction()
    {
        parent::initializeAction();
        $this->customer = SubjectResolver::get()
            ->forClassName(Customer::class)
            ->forPropertyName('user')
            ->resolve();
    }

    public function indexAction()
    {
        // notice: no custom queries here, we're using Customer as aggregate root
        // to retrieve Address and BankAccount entities (fetched automatically)
        $this->view->assignMultiple([
            'addresses' => $this->customer->getAddresses(),
            'bankAccounts' => $this->customer->getBankAccounts(),
        ]);
    }

    /***************************************************************************
     * Address related
     */

    public function newAddressAction(Address $address = null)
    {
        if ($address === null) {
            $address = $this->objectManager->get(Address::class);
        }
        $this->view->assign('address', $address);
    }

    public function createAddressAction(Address $address)
    {
        $this->customer->addAddress($address);
        $this->persistenceManager->add($address);
        $this->persistenceManager->update($this->customer);
        $this->redirect('index');
    }

    public function editAddressAction(Address $address)
    {
        $this->assertAddressPermission($address);
        $this->view->assign('address', $address);
    }

    public function updateAddressAction(Address $address)
    {
        $this->assertAddressPermission($address);
        $this->persistenceManager->update($address);
        $this->redirect('index');
    }

    public function deleteAddressAction(Address $address)
    {
        $this->assertAddressPermission($address);
        $this->customer->removeAddress($address);
        $this->persistenceManager->remove($address);
        $this->persistenceManager->update($this->customer);
        $this->redirect('index');
    }

    /***************************************************************************
     * BankAccount related
     */

    public function newBankAccountAction(BankAccount $bankAccount = null)
    {
        if ($bankAccount === null) {
            $bankAccount = $this->objectManager->get(BankAccount::class);
        }
        $this->view->assign('bankAccount', $bankAccount);
    }

    /**
     * @param BankAccount $bankAccount
     * @TYPO3\CMS\Extbase\Annotation\Validate("OliverHader\BookStoreApp\Validator\BankAccountValidator", param="bankAccount", options={"prefix":"DE"})
     */
    public function createBankAccountAction(BankAccount $bankAccount)
    {
        $this->customer->addBankAccount($bankAccount);
        $this->persistenceManager->add($bankAccount);
        $this->persistenceManager->update($this->customer);
        $this->redirect('index');
    }

    public function editBankAccountAction(BankAccount $bankAccount)
    {
        $this->assertBankAccountPermission($bankAccount);
        $this->view->assign('bankAccount', $bankAccount);
    }

    public function updateBankAccountAction(BankAccount $bankAccount)
    {
        $this->assertBankAccountPermission($bankAccount);
        $this->persistenceManager->update($bankAccount);
        $this->redirect('index');
    }

    public function deleteBankAccountAction(BankAccount $bankAccount)
    {
        $this->assertBankAccountPermission($bankAccount);
        $this->customer->removeBankAccount($bankAccount);
        $this->persistenceManager->remove($bankAccount);
        $this->persistenceManager->update($this->customer);
        $this->redirect('index');
    }

    private function assertAddressPermission(Address $address = null)
    {
        // no UID means "not persisted" yet -> new entity
        if ($address === null || $address->getUid() !== 0) {
            return;
        }
        if (!$this->customer->getAddresses()->contains($address)) {
            throw new PermissionException(
                sprintf('No permission to access address "%d"', $address->getUid()),
                1576615121
            );
        }
    }

    private function assertBankAccountPermission(BankAccount $bankAccount = null)
    {
        // no UID means "not persisted" yet -> new entity
        if ($bankAccount === null || $bankAccount->getUid() !== 0) {
            return;
        }
        if (!$this->customer->getBankAccounts()->contains($bankAccount)) {
            throw new PermissionException(
                sprintf('No permission to access bank account "%d"', $bankAccount->getUid()),
                1576615122
            );
        }
    }
}

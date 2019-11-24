<?php
namespace OliverHader\BookStoreApp\Controller;


/***
 *
 * This file is part of the "Book Store App" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2019 Oliver Hader <oliver.hader.2@hof-university.de>
 *
 ***/
/**
 * CountryController
 */
class CountryController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * countryRepository
     * 
     * @var \OliverHader\BookStoreApp\Domain\Repository\CountryRepository
     */
    protected $countryRepository = null;

    /**
     * @param \OliverHader\BookStoreApp\Domain\Repository\CountryRepository $countryRepository
     */
    public function injectCountryRepository(\OliverHader\BookStoreApp\Domain\Repository\CountryRepository $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $countries = $this->countryRepository->findAll();
        $this->view->assign('countries', $countries);
    }

    /**
     * action show
     * 
     * @param \OliverHader\BookStoreApp\Domain\Model\Country $country
     * @return void
     */
    public function showAction(\OliverHader\BookStoreApp\Domain\Model\Country $country)
    {
        $this->view->assign('country', $country);
    }

    /**
     * action new
     * 
     * @return void
     */
    public function newAction()
    {
    }

    /**
     * action create
     * 
     * @param \OliverHader\BookStoreApp\Domain\Model\Country $newCountry
     * @return void
     */
    public function createAction(\OliverHader\BookStoreApp\Domain\Model\Country $newCountry)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->countryRepository->add($newCountry);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param \OliverHader\BookStoreApp\Domain\Model\Country $country
     * @ignorevalidation $country
     * @return void
     */
    public function editAction(\OliverHader\BookStoreApp\Domain\Model\Country $country)
    {
        $this->view->assign('country', $country);
    }

    /**
     * action update
     * 
     * @param \OliverHader\BookStoreApp\Domain\Model\Country $country
     * @return void
     */
    public function updateAction(\OliverHader\BookStoreApp\Domain\Model\Country $country)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->countryRepository->update($country);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param \OliverHader\BookStoreApp\Domain\Model\Country $country
     * @return void
     */
    public function deleteAction(\OliverHader\BookStoreApp\Domain\Model\Country $country)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->countryRepository->remove($country);
        $this->redirect('list');
    }
}

<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Testwork\Hook\Scope\BeforeSuiteScope;
use Drupal\DrupalExtension\Context\RawDrupalContext;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends RawDrupalContext implements SnippetAcceptingContext
{
    /**
     * @When I wait for :arg1 secs
     */
    public function iWaitForSecs($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When I add fields to the video content type
     */
    public function iAddFieldsToTheVideoContentType()
    {
        $this->addFieldToContentType('Draco Video progress bar', 'dvpb');
        $this->addFieldToContentType('Draco Video reference', 'dvr');
        $this->addFieldToContentType('Draco Video thumbnails', 'dvt');
        $this->addFieldToContentType('Draco Video upload', 'dvu');
    }

    public function addFieldToContentType($Field, $Name)
    {
        $this->getSession()->getPage()->clickLink("Add field");
        $this->assertSession()->pageTextContains("Add field");
        $this->getSession()->wait(2000);
        $this->getSession()->getPage()->selectFieldOption('Add a new field', $Field);
        $this->getSession()->getPage()->fillField('edit-label', $Name);
        $this->getSession()->wait(2000);
        $this->getSession()->getPage()->pressButton('Save and continue');
        $this->getSession()->wait(2000);
        $this->getSession()->getPage()->pressButton('Save field settings');
        $this->getSession()->wait(2000);
        $this->getSession()->getPage()->pressButton('Save settings');
        $this->assertSession()->pageTextContains("Saved $Name configuration.");
    }

    /**
     * @Then I should see the added fields
     */
    public function iShouldSeeTheAddedFields()
    {
        $this->visitPath("/admin/structure/types/manage/video/fields");
        $this->assertSession()->pageTextContains("Draco Video progress bar");
        $this->assertSession()->pageTextContains("Draco Video reference");
        $this->assertSession()->pageTextContains("Draco Video thumbnails");
        $this->assertSession()->pageTextContains("Draco Video upload");
    }

}

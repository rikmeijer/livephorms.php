<?php
namespace Livephorms;

class FormTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testFormConstruction()
    {
		$form = new Form("MyForm");
    }
}
<?php

/**
 * @file
 * Contains \Drupal\Tests\template_mapper\TemplateMapperTest.
 *
 * @todo This test class is not "good" or complete. It is here to provide
 * Travis with a unit test to be run.
 */

namespace Drupal\Tests\template_mapper;

use Drupal\template_mapper\Entity\TemplateMapper;
use Drupal\Tests\UnitTestCase;

/**
 * Test the WorkflowState Class.
 *
 * @coversDefaultClass Drupal\template_mapper\Entity\TemplateMapper
 * @group template_mapper
 */
class TemplateMapperTest extends UnitTestCase {

  /**
   * The autocomplete controller.
   *
   * @var Drupal\template_mapper\Entity\TemplateMapper;
   */
  protected $templateMapper;




  /**
   * {@inheritdoc}
   */
  protected function setUp() {

    // @todo, hard-coding this state might be a bad idea.
    // Is a data provider better?
    $templateMapper = [
      'id' => 'node',
    ];
    $this->templateMapper = new TemplateMapper($templateMapper,
      'template_mapper');
  }

  /**
   * Tests the label method.
   */
  public function testGetIdMethod() {


    $this->assertEquals('node', $this->templateMapper->id());
  }
}

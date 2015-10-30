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
      'mappings' => 'node__article|node__piece/node__teaser|node__illustrated_list_item',
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

  /**
   * Tests the getMappingArray Method.
   */
  public function testGetMappingArrayMethod() {

    $expected_mappings_array = [
      'node__article' => 'node__piece',
      'node__teaser' => 'node__illustrated_list_item',
    ];
    $this->assertEquals($expected_mappings_array,
      $this->templateMapper->getMappingsArray());
  }

  /**
   * Tests the performMapping Method.
   */
  public function testPerformMappingMethod() {

    $existing_suggestions = [
      'node',
      'node__article',
      'node__full',
    ];
    $expect_new_suggestions = [
      'node',
      'node__piece',
      'node__full',
    ];
    $this->assertEquals($expect_new_suggestions,
      $this->templateMapper->performMapping($existing_suggestions));

  }
}

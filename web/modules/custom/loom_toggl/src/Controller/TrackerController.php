<?php

namespace Drupal\loom_toggl\Controller;

use Drupal\Core\Controller\ControllerBase;
use MorningTrain\TogglApi\TogglApi;
use MorningTrain\TogglApi\TogglReportsApi;

/**
 * Class TrackerController.
 */
class TrackerController extends ControllerBase
{

  /**
   * Default.
   *
   * @return string
   *   Return Hello string.
   */
  public function output() {
    $current = \Drupal::currentUser();
    // $user = \Drupal\user\Entity\User::load($current->id());
    $user = \Drupal::entityManager()->getStorage('user')->load($current->id());
    $toggleKey = $user->get('field_api_key_toggl')->value;
    $toggl = new TogglApi($toggleKey);
    $entries = $toggl->getTimeEntries();


    $togglReports = new TogglReportsApi($toggleKey);
    $endpoints = $togglReports->getAvailableEndpoints();
    $detailed = $togglReports->getDetailsReport(['page' => 1]);


    $t=1;
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: output')
    ];
  }

}

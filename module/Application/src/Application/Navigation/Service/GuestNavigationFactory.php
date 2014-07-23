<?php

namespace Application\Navigation\Service;

use Zend\Navigation\Service\DefaultNavigationFactory;

class GuestNavigationFactory extends DefaultNavigationFactory {
	protected function getName() {
		return 'guest';
	}
}
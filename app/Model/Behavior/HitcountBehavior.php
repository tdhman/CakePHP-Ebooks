<?php
/*
	This file is part of NeutrinoCMS.

	NeutrinoCMS is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	NeutrinoCMS is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with NeutrinoCMS.  If not, see <http://www.gnu.org/licenses/>.
*/

class HitcountBehavior extends ModelBehavior
{
	var $name = 'HitcountBehavior';
	var $__defaultOptions = array('keyField' => 'id', 'hitField' => 'hitcount');
	var $mapMethods = array('/hit/' => 'hit');

	/**
	 * Setup behaviour.
	 *
	 * @param Model $Model
	 * @param array $settings
	 */
	function setup(Model $model, $settings = array())
	{
		if (!isset($this->settings[$model->alias]))
		{
			if (empty($settings))
			{
				$this->settings[$model->alias] = $this->__defaultOptions;
			}
			else if (is_array($settings))
			{
				$this->settings[$model->alias] = array_merge($this->__defaultOptions, $settings);
			}
		}
	}

	/**
	 * Register a hit in the database.
	 *
	 * @param Model $Model
	 * @param mixed $key
	 */
	function hit(Model $model, $key = null, $settings = null)
	{
		$_settings = array();

		if (isset($this->settings[$model->alias]))
			$_settings = $this->settings[$model->alias];

		if (is_array($settings))
			$_settings = array_merge($_settings, $settings);

		if (!isset($_settings['hitField']) || !isset($_settings['keyField']))
		{
			$this->log('Miscofigured hitcount behavior!', LOG_WARNING);
			return;
		}

		if (!$model->hasField($_settings['keyField']))
			return;

		if (!$model->hasField($_settings['hitField']))
			return;

		if (empty($key))
			$key = $model->id;

		if (empty($key))
		{
			$this->log('Invalid call to hitcount behavior!', LOG_WARNING);
			return;
		}

		$model->updateAll
			(
				array ($_settings['hitField'] => $model->alias.'.'.$_settings['hitField'].' + 1'),
				array ($model->alias.'.'.$_settings['keyField'] => $key)
			);
	}
}

?>
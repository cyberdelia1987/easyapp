<?php
/**
 * Alexandr Sibov aka Cyber (cyberdelia1987@gmail.com)
 * Дата создания: 07.10.12 1:07
 */
class MLib_Application
{
	/**
	 * @var null
	 */
	static protected $_instance = null;

	/**
	 *
	 */
	protected function __construct() {}

	/**
	 * @return MLib_Application|null
	 */
	static public function getInstance()
	{
		if (self::$_instance == null)
		{
			self::$_instance = new MLib_Application();
		}

		return self::$_instance;
	}

	/**
	 * @TODO: вынести обработку ошибок в отдельный класс
	 */
	public function run()
	{
		try
		{
			// Запускаем сессию
			MLib_Session::getInstance()->start();
			// Запускаем маршрутизацию
			MLib_Router::getInstance()->route();
			// Обработка вывода AJAX-данных, если инициализировались
			MLib_Ajax::getInstance()->display();
		}
		catch(Exception $ex)
		{
			echo 'Код ошибки: '.$ex->getCode().'<br/>';
			echo 'Текст ошибки: '.$ex->getMessage().'</br>';
			echo '<br/>';
			echo 'Бэктрейс:<br/>';
			vre($ex->getTraceAsString());
			die();
		}
	}

	final protected function __clone() {}
}
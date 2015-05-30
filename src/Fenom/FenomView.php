<?php

    namespace Pafnuty\Fenom;

    use Illuminate\Contracts\View\View as ViewContract;

    /**
     * Class FenomView
     *
     * @author  Pavel Belousov pafnuty10@gmail.com
     * @author  Max Kostjukevich support@maxicms.ru
     * @license http://opensource.org/licenses/MIT MIT
     */

    class FenomView implements ViewContract
    {
        /*
         * View to render
         * @var string
         * */
        private $view;

        /*
         * Data to pass to the view
         * @var array
         * */
        private $data;

        /*
         * Fenom factory
         * @var Panfuty\Fenom\FenomFactory
         * */
        private $factory;


	    /**
	     * @param \Pafnuty\Fenom\FenomFactory $factory
	     * @param                             $view
	     * @param array                       $data
	     */
	    public function __construct(FenomFactory $factory, $view, $data = [])
        {
            $this->factory = $factory;
            $this->view    = $view;
            $this->data    = $data;
        }

	    /**
	     * @return mixed
	     */
	    public function name()
        {
            return $this->view;
        }

	    /**
	     * @param array|string $key
	     * @param null         $value
	     *
	     * @return $this
	     */
	    public function with($key, $value = null)
        {
            $this->data[$key] = $value;

            return $this;
        }

	    /**
	     * @return mixed
	     */
	    public function __toString()
        {
            return $this->render();
        }

	    /**
	     * @return mixed
	     */
	    public function render()
        {
            return $this->factory->render($this->view, $this->data);
        }

    }

<?php
namespace CBlock\CMSBlock\Block;
class Display extends \Magento\Framework\View\Element\Template
{
public function __construct(\Magento\Framework\View\Element\Template\Context $context)
{
parent::__construct($context);
}
public function sayWelcome()
{
return __('Welcome!');
}
}
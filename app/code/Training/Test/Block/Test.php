<?php
namespace Training\Test\Block;

class Test extends \Magento\Framework\View\Element\AbstractBlock
{
  protected function _toHtml() {
    $helloooo = "<img src='https://media.tenor.com/images/44dbcd137f211757d0685e7d41d694aa/tenor.gif'>";
    return "<b>HellooooOOOOoooo from block!</b><br/>" . $helloooo . "<br/> -Mr. Jackpots";
  }
}

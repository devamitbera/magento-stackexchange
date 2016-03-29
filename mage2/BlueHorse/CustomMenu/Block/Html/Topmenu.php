<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace BlueHorse\CustomMenu\Block\Html;

use Magento\Theme\Block\Html\Topmenu as Basetopmenu;

/**
 * Html page top menu block
 */
class Topmenu extends Basetopmenu
{

    /**
     * Get top menu html
     *
     * @param string $outermostClass
     * @param string $childrenWrapClass
     * @param int $limit
     * @return string
     */
    public function getHtml($outermostClass = '', $childrenWrapClass = '', $limit = 0)
    {
        $this->_eventManager->dispatch(
            'page_block_html_topmenu_gethtml_before',
            ['menu' => $this->_menu, 'block' => $this]
        );

        $this->_menu->setOutermostClass($outermostClass);
        $this->_menu->setChildrenWrapClass($childrenWrapClass);

        $html = $this->_getHtml($this->_menu, $childrenWrapClass, $limit);

        $transportObject = new \Magento\Framework\DataObject(['html' => $html]);
        $this->_eventManager->dispatch(
            'page_block_html_topmenu_gethtml_after',
            ['menu' => $this->_menu, 'transportObject' => $transportObject]
        );
        $html = $transportObject->getHtml();

        return $html;
    }

    /**
     * Count All Subnavigation Items
     *
     * @param \Magento\Backend\Model\Menu $items
     * @return int
     */
    protected function _countItems($items)
    {
        $total = $items->count();
        foreach ($items as $item) {
            /** @var $item \Magento\Backend\Model\Menu\Item */
            if ($item->hasChildren()) {
                $total += $this->_countItems($item->getChildren());
            }
        }
        return $total;
    }

    /**
     * Building Array with Column Brake Stops
     *
     * @param \Magento\Backend\Model\Menu $items
     * @param int $limit
     * @return array|void
     *
     * @todo: Add Depth Level limit, and better logic for columns
     */
    protected function _columnBrake($items, $limit)
    {
        $total = $this->_countItems($items);
        if ($total <= $limit) {
            return;
        }

        $result[] = ['total' => $total, 'max' => (int)ceil($total / ceil($total / $limit))];

        $count = 0;
        $firstCol = true;

        foreach ($items as $item) {
            $place = $this->_countItems($item->getChildren()) + 1;
            $count += $place;

            if ($place >= $limit) {
                $colbrake = !$firstCol;
                $count = 0;
            } elseif ($count >= $limit) {
                $colbrake = !$firstCol;
                $count = $place;
            } else {
                $colbrake = false;
            }

            $result[] = ['place' => $place, 'colbrake' => $colbrake];

            $firstCol = false;
        }

        return $result;
    }

    /**
     * Add sub menu HTML code for current menu item
     *
     * @param \Magento\Framework\Data\Tree\Node $child
     * @param string $childLevel
     * @param string $childrenWrapClass
     * @param int $limit
     * @return string HTML code
     */
    protected function _addSubMenu($child, $childLevel, $childrenWrapClass, $limit)
    {
        $url=explode('/',$child->getUrl());
		$length=count($url);
		$lastelment=$url[$length-1];
		$uri=explode('.',$lastelment);
		$blockidentifier=$uri[0];
		
		$html = '';
        if (!$child->hasChildren()) {
            return $html;
        }

        $colStops = null;
        if ($childLevel == 0 && $limit) {
            $colStops = $this->_columnBrake($child->getChildren(), $limit);
        }

        $html .= '<ul class="dropdown-menu mega-dropdown-menu">';
        $html .= $this->getLayout()->createBlock('Magento\Cms\Block\Block')->setBlockId($blockidentifier)->toHtml();
        $html .= $this->_getHtmlSubmenu($child, $childrenWrapClass, $limit, $colStops);
        $html .= '</ul>';

        return $html;
    }

    /**
     * Recursively generates top menu html from data that is specified in $menuTree
     *
     * @param \Magento\Framework\Data\Tree\Node $menuTree
     * @param string $childrenWrapClass
     * @param int $limit
     * @param array $colBrakes
     * @return string
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    protected function _getHtml(\Magento\Framework\Data\Tree\Node $menuTree,$childrenWrapClass,$limit,
        $colBrakes = []
    ) {
        $html = '';

        $children = $menuTree->getChildren();
        $parentLevel = $menuTree->getLevel();
        $childLevel = $parentLevel === null ? 0 : $parentLevel + 1;

        $counter = 1;
        $itemPosition = 1;
        $childrenCount = $children->count();

        $parentPositionClass = $menuTree->getPositionClass();
        $itemPositionClassPrefix = $parentPositionClass ? $parentPositionClass . '-' : 'nav-';

        foreach ($children as $child) {
			
			$url=explode('/',$child->getUrl());
			$length=count($url);
			$lastelment=$url[$length-1];
			$uri=explode('.',$lastelment);
			$blockidentifier=$uri[0];
			
            $child->setLevel($childLevel);
            $child->setIsFirst($counter == 1);
            $child->setIsLast($counter == $childrenCount);
            $child->setPositionClass($itemPositionClassPrefix . $counter);

            $outermostClassCode = '';
            $outermostClass = $menuTree->getOutermostClass();

            if ($childLevel == 0 && $outermostClass) {
                $outermostClassCode = ' class="' . $outermostClass . ' dropdown-toggle border-active" ';
                $child->setClass($outermostClass);
            }

            if (count($colBrakes) && $colBrakes[$counter]['colbrake']) {
                $html .= '</ul></li><li class="column"><ul>';
            }
             if($child->getId()=="category-node-3" ||  $child->getId()=="category-node-9"){
				$html .= '<li ' . $this->_getRenderedMenuItemAttributes($child) . '>';
				$html .= '<a  href="'.$child->getUrl().'"  ' . $outermostClassCode . ' data-toggle="dropdown"><span>' . $this->escapeHtml(
					$child->getName()
				) . '</span></a>';
				$html .= '<ul class="dropdown-menu mega-dropdown-menu">';
				$html .= $this->getLayout()->createBlock('Magento\Cms\Block\Block')->setBlockId($blockidentifier)->toHtml();
				$html .= '</ul>';
				$html .=  '</li>';
			 }
			 else{
				$html .= '<li ' . $this->_getRenderedMenuItemAttributes($child) . '>';
				$html .= '<a  href="'.$child->getUrl().'"  ' . $outermostClassCode . ' data-toggle="dropdown"><span>' . $this->escapeHtml(
					$child->getName()
				) . '</span></a>' . $this->_addSubMenu(
					$child,
					$childLevel,
					$childrenWrapClass,
					$limit
				) . '</li>';
			 }
            $itemPosition++;
            $counter++;
        }

        if (count($colBrakes) && $limit) {
            $html = '<li class="column"><ul>' . $html . '</ul></li>';
        }

        return $html;
    }
    
    
    protected function _getHtmlSubmenu(
	  \Magento\Framework\Data\Tree\Node $menuTree,
        $childrenWrapClass,
        $limit,
        $colBrakes = []
    ) {
        $html = '';
		$html .= '<li class="col-sm-3 drop-widthR" >';
        $html .= '<h4>Shop by Category</h4>';
		$html .= '<ul>';	  

        $children = $menuTree->getChildren();
        foreach ($children as $child) {
			$html .= '<li>';
            $html .= '<a href="' . $child->getUrl() . '">' . $this->escapeHtml($child->getName()) . '</a> </li>';
          }
		$html .= '</ul>';
		$html .= '</li>';
        
        return $html;
    }

    /**
     * Generates string with all attributes that should be present in menu item element
     *
     * @param \Magento\Framework\Data\Tree\Node $item
     * @return string
     */
    protected function _getRenderedMenuItemAttributes(\Magento\Framework\Data\Tree\Node $item)
    {
        $html = '';
        $attributes = $this->_getMenuItemAttributes($item);
        foreach ($attributes as $attributeName => $attributeValue) {
            $html .= ' ' . $attributeName . '="' . str_replace('"', '\"', $attributeValue) . '"';
        }
        return $html;
    }

    /**
     * Returns array of menu item's attributes
     *
     * @param \Magento\Framework\Data\Tree\Node $item
     * @return array
     */
    protected function _getMenuItemAttributes(\Magento\Framework\Data\Tree\Node $item)
    {
        $menuItemClasses = $this->_getMenuItemClasses($item);
        return ['class' => implode(' ', $menuItemClasses)];
    }

    /**
     * Returns array of menu item's classes
     *
     * @param \Magento\Framework\Data\Tree\Node $item
     * @return array
     */
    protected function _getMenuItemClasses(\Magento\Framework\Data\Tree\Node $item)
    {
        $classes = [];

        $classes[] = 'level' . $item->getLevel();
        $classes[] = $item->getPositionClass();
       
        $classes[]= 'dropdown mega-dropdown';
        
        if ($item->getIsFirst()) {
            $classes[] = 'first';
        }

        if ($item->getIsActive()) {
            $classes[] = 'active';
        } elseif ($item->getHasActive()) {
            $classes[] = 'has-active';
        }

        if ($item->getIsLast()) {
            $classes[] = 'last';
        }

        if ($item->getClass()) {
            $classes[] = $item->getClass();
        }

        if ($item->hasChildren()) {
            $classes[] = 'parent';
        }

        return $classes;
    }

    /**
     * Add identity
     *
     * @param array $identity
     * @return void
     */
    public function addIdentity($identity)
    {
        $this->identities[] = $identity;
    }

    /**
     * Get identities
     *
     * @return array
     */
    public function getIdentities()
    {
        return $this->identities;
    }
}

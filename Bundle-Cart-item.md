```
        if ($cart){
            $cartItems = $cart->getItems();
            foreach ($cartItems as $cartItem){
                /**
                 * @var \Magento\Quote\Model\Quote\Item| \Magento\Quote\Api\Data\CartItemInterface $cartItem
                 */

                $selectionsQuoteItemOptions = $cartItem->getQtyOptions();
                foreach ($selectionsQuoteItemOptions as $selectionsQuoteItemOption){
                    /**
                     * @var \Magento\Quote\Model\Quote\Item\Option $selectionsQuoteItemOption
                     */
                    echo $selectionsQuoteItemOption->getValue();
                    echo PHP_EOL;
                    echo $selectionsQuoteItemOption->getProductId();
                    echo PHP_EOL;
                }



              //  print_r($cartItem->getProductOption()->getExtensionAttributes()->getBundleOptions());

               // $optionsQuoteItemOption = $cartItem->getOptionByCode('bundle_option_ids');
            }
        }
   ```

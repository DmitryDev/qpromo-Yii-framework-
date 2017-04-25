<?php
/**
 * Mailer class file
 * 

 *  
 * @author Sergey Muzyka <sergey@loginaut.com>
 * @copyright Copyright &copy; 2012 Loginaut LLC
 */

/**
 * Mailer is a special component-class helping to send emails
 *
 * Mailer is used as an application component whose ID is 'mailer'.
 * Therefore, at any place one can access the mailer via
 * <code>Yii::app()->mailer</code>.
 *
 */


class Mailer extends CApplicationComponent 
{
    const USER_SIGNED_UP    = 1;
    const USER_SUBSCRIBED   = 2;
    const USER_GUEST        = 3;
    
    private $_style         = array();    
    private $_node          = NULL;
    private $_nodeChildren  = array();    
    private $_from          = '';
    private $_to            = '';
    private $_plainText     = '';
    private $_htmlText      = '';
    private $_subject       = '';
    private $_user          = null;    
    private $_userName      = '';
    private $_host          = '';


    public function registration($user_email)
    {
        if (!$this->prepareUser($user_email, self::USER_SUBSCRIBED)) return false;
        
        $plainContent = "Hi {$this->_userName}\n\n";
        $plainContent.= "Thank you for signing up to {$this->_host}!\n";
        $plainContent.= "Have any questions or comments? Please contact us at Support@Rumordeals.com and ";
        $plainContent.= "we will try to respond within one business day.\n";
        $plainContent.= "Please do not respond directly to this e-mail message because that ";
        $plainContent.= "won't really work. That's due to the fact that this is an automated e-mail.\n";
        $plainContent.= "Happy shopping!\n\n";
        $plainContent.= "Sincerely, {$this->_host}\n";
        
        $htmlContent = "<h1 style=\"{$this->_style['greeting']}\">Hi <strong>{$this->_userName}</strong></h1>\n";
        $htmlContent.= "<p>Thank you for signing up to <a href=\"http://{$this->_host}\" style=\"{$this->_style['content_link']}\">{$this->_host}</a>!</p>\n";
        $htmlContent.= "<p>Have any questions or comments? Please contact us at ";
        $htmlContent.= "<a href=\"mailto:support@rumordeals.com\" style=\"{$this->_style['content_link']}\">support@rumordeals.com</a> and ";
        $htmlContent.= "we will try to respond within one business day. Please do not respond directly to this ";
        $htmlContent.= "e-mail message because that won't really work. That's due to the fact that this is an automated e-mail.</p>\n";
        $htmlContent.= "<p>Happy shopping!</p>\n";
        $htmlContent.= "<p>Sincerely,<br /><a href=\"http://{$this->_host}\" style=\"{$this->_style['content_link']}\">" . Yii::app()->name. "</a></p>";	    
        
        $subject    = "Successfull Registration";
        $params = array('title' => "Successfull Registration");
        
        if (!$this->prepareLetter($plainContent, $htmlContent, $subject, $params)) return false;        
        return $this->sendMultipartMail();
    }
    
    public function forgotPassword($user_email)
    {                
        if (!$this->prepareUser($user_email, self::USER_SIGNED_UP)) return false;
        
        // Send an email to change a password for the $user
        $token = new Token;
        $token->tag = $user_email;
        if (!$token->save()) return false;
        
        $plainContent = "Hi {$this->_userName}\n\n";
        $plainContent.= "There was recently a request to change the password on your account.\n";
        $plainContent.= "You need to follow the link " . Yii::app()->createAbsoluteUrl('password/change', array('token'=>$token->value));
        $plainContent.= " and provide new password.\n";        
        $plainContent.= "If you don't want to change your password, just ignore this message.\n\n";
        $plainContent.= "Sincerely, {$this->_host}\n";
        
        $htmlContent = "<h1 style=\"{$this->_style['greeting']}\">Hi <strong>{$this->_userName}</strong></h1>\n";
        $htmlContent.= "<p>There was recently a request to change the password on your account.</p>";
        $htmlContent.= "<p>You need to go <a href=\"".Yii::app()->createAbsoluteUrl('password/change', array('token'=>$token->value));
        $htmlContent.= "\" style=\"{$this->_style['content_link']}\">here</a> and provide new password.</p>\n";
        $htmlContent.= "<p>If you don't want to change your password, just ignore this message.</p>";        
        $htmlContent.= "<p>Sincerely,<br /><a href=\"http://{$this->_host}\" style=\"{$this->_style['content_link']}\">" . Yii::app()->name. "</a></p>";	    
        
        $subject    = "Forgot password?";
        $params = array('title' => "Forgot Password?");
        
        if (!$this->prepareLetter($plainContent, $htmlContent, $subject, $params)) return false;        
        return $this->sendMultipartMail();
    }
    
    public function passwordChanged($user_email)
    {
        if (!$this->prepareUser($user_email, self::USER_SIGNED_UP)) return false;
        
        $plainContent = "Hi {$this->_userName}\n\n";
        $plainContent.= "Your password successfully changed.\n\n";                
        $plainContent.= "Sincerely, {$this->_host}\n";
        
        $htmlContent = "<h1 style=\"{$this->_style['greeting']}\">Hi <strong>{$this->_userName}</strong></h1>\n";
        $htmlContent.= "<p>Your password successfully changed.</p>\n";        
        $htmlContent.= "<p>Sincerely,<br /><a href=\"http://{$this->_host}\" style=\"{$this->_style['content_link']}\">" . Yii::app()->name. "</a></p>";	    
        
        $subject    = "Password changed";
        $params = array('title' => "Password Changed");
        
        if (!$this->prepareLetter($plainContent, $htmlContent, $subject, $params)) return false;        
        return $this->sendMultipartMail();
    }
    
    public function sendPromo($user_email, $promo_id)
    {
        $promo = Promo::model()->findByPk($promo_id);
        if ($promo === NULL) return false;
        
        if (!$this->prepareUser($user_email, self::USER_SUBSCRIBED)) return false;
                        
        $plainContent = "Hi {$this->_userName}\n\n";
        $plainContent.= "Here is a reminder to use your {$promo->name} promo code we were telling you about!\n";                
        $plainContent.= "{$promo->discount}% off of one of your AMAZING deals on our site is truly something \n";                
        $plainContent.= "that will keep you smiling until spring.!\n\n";
        $plainContent.= "Use it now: {$promo->name} \n\n";
        $plainContent.= "Use it quick because times running out! This offer expires " . date('M j,Y', strtotime($promo->expire_at)) . ". \n\n";
        $plainContent.= "Sincerely, {$this->_host}\n";
        
        $htmlContent = "<h1 style=\"{$this->_style['greeting']}\">Hi <strong>{$this->_userName}</strong></h1>\n";
        $htmlContent.= "<p>Here is a reminder to use your {$promo->name} promo code we were telling you about!</p>\n";        
        $htmlContent.= "<p>{$promo->discount}% off of one of your AMAZING deals on our site is truly something \n";
        $htmlContent.= "that will keep you smiling until spring.</p>\n";
        $htmlContent.= "<p>Use it <a href=\"http://{$this->_host}\" style=\"{$this->_style['content_link']}\">now</a>: {$promo->name}</p>\n";
        $htmlContent.= "<p>Use it quick because times running out! This offer expires " . date('M j,Y', strtotime($promo->expire_at)) . "</p>\n";
        $htmlContent.= "<p>Sincerely,<br /><a href=\"http://{$this->_host}\" style=\"{$this->_style['content_link']}\">" . Yii::app()->name. "</a></p>";	    
        
        $subject    = "The Best Gifts for WAY Less!";
        $params = array('title' => "The Best Gifts for WAY Less!");
        
        if (!$this->prepareLetter($plainContent, $htmlContent, $subject, $params)) return false;        
        return $this->sendMultipartMail();
    }
    
    public function sendShippingNotice($user_email, $order_id)
    {
        if (!$this->prepareUser($user_email, self::USER_SIGNED_UP)) return false;
        
        $order = Order::model()->findByPk($order_id);
        if ($order===null) return false;
        
        $agent = '';
        switch ($order->shipping_agent) {
            case Order::SHIPPING_UPS:
                $agent = 'UPS';
                break;
            case Order::SHIPPING_USPS :
                $agent = 'USPS';
                break;            
            case Order::SHIPPING_FEDEX:
                $agent = 'FedEx';
                break;
        }
        
        $plainContent = "Hi {$this->_userName}\n\n";
        $plainContent.= "Your order #{$order->id} has shipped!\n";
        $plainContent.= "Shipping agent: $agent\n";
        $plainContent.= "Tracking #: {$order->tracking_number}\n\n";
        $plainContent.= "You may also check out your {$this->_host} ";
        $plainContent.= "account to track the status of your order.\nIf you have any questions about your order please contact us at ";
        $plainContent.= "info@rumordeals.com.\n";        
        $plainContent.= "Thank you again for your business. We hope your order arrives quickly and safely.\n\n";
        $plainContent.= "Sincerely, {$this->_host}\n";
        
        $htmlContent = "<h1 style=\"{$this->_style['greeting']}\">Hi <strong>{$this->_userName}</strong></h1>\n";
        $htmlContent.= "<p>Your order #{$order->id} has shipped via $agent agent (tracking #{$order->tracking_number}).</p>\n";        
        $htmlContent.= "<p>You may also check out your <a href=\"http://{$this->_host}\" style=\"{$this->_style['content_link']}\">{$this->_host}</a> ";
        $htmlContent.= "account to track the status of your order. If you have any questions about your order please contact us at ";        
        $htmlContent.= "<a href=\"mailto:info@rumordeals.com\" style=\"{$this->_style['content_link']}\">info@rumordeals.com</a>.</p>";
        $htmlContent.= "<p>Thank you again for your business. We hope your order arrives quickly and safely.</p>\n";                
        $htmlContent.= "<p>Sincerely,<br /><a href=\"http://{$this->_host}\" style=\"{$this->_style['content_link']}\">" . Yii::app()->name. "</a></p>";	    
        
        $subject    = "Order #$order_id has shipped";
        $params = array('title' => "Order Has Shipped<br/><strong>#$order_id</strong>");
        
        if (!$this->prepareLetter($plainContent, $htmlContent, $subject, $params)) return false;        
        return $this->sendMultipartMail();
    }
    
    public function invoice($user_email, $order_id)
    {
        $order = Order::model()->findByPk($order_id);
        if ($order===null) return false;
        
        if (!$this->prepareUser($user_email, self::USER_SIGNED_UP)) return false;
        
        $plainContent = $this->plainInvoice($order);        
        $htmlContent  = $this->htmlInvoice($order);
        
        $subject    = Yii::app()->name . ' Order Invoice #' . $order_id;
        $title = 'Your order is ';
        switch ($order->status) {            
            case Order::STATUS_PAID:
                $title .= 'processing';
                break;
            case Order::STATUS_DELIVERING:
                $title .= 'delivering';
                break;
            case Order::STATUS_CANCELED:
                $title .= 'canceled';
                break;
            case Order::STATUS_REJECTED:
                $title .= 'rejected';
                break;
            case Order::STATUS_COMPLETED:
                $title .= 'completed';
                break;            
            default:
                $title .= 'rejected';
        }
        $params = array('title' => $title);
        
        if (!$this->prepareLetter($plainContent, $htmlContent, $subject, $params)) return false;        
        return $this->sendMultipartMail();
    }
    
    private function htmlInvoice($order) {
        $htmlContent = "<h1 style=\"{$this->_style['greeting']}\">Hi <strong>{$this->_userName}</strong></h1>\n";
        $htmlContent.= "<p>Thank you for your order from <a href=\"http://{$this->_host}\" style=\"{$this->_style['content_link']}\">{$this->_host}</a>.</p>\n";
        if ($order->status == Order::STATUS_PAID) {
            $htmlContent.= "<p>Once your package ships, we will send you an email with a link to track it.\n";
            $htmlContent.= "You may also check out your <a href=\"http://{$this->_host}\" style=\"{$this->_style['content_link']}\">{$this->_host}</a> account to track the status of your order.</p>";
        } elseif ($order->status == Order::STATUS_DELIVERING) {
            $htmlContent.= "<p>You may check out your <a href=\"http://{$this->_host}\" style=\"{$this->_style['content_link']}\">{$this->_host}</a> account to track the status of your order.</p>";
        }       
        $htmlContent.= "<p>If you have any questions about your order please contact us at ";        
        $htmlContent.= "<a href=\"mailto:info@rumordeals.com\" style=\"{$this->_style['content_link']}\">info@rumordeals.com</a>.</p>";
        $htmlContent.= "<p>Thank you again for your business.";
         if ($order->status == Order::STATUS_DELIVERING ||$order->status == Order::STATUS_PAID) {
            $htmlContent.= " We hope your order arrives quickly and safely.</p>\n";                
        } else {
            $htmlContent.= "</p>\n";
        }
        
        $htmlContent.= "<h4 style=\"{$this->_style['invoice_h4']}\"><i style=\"{$this->_style['invoice_h4_i']}\">></i>";
        $htmlContent.= "Order #{$order->id}<span style=\"{$this->_style['invoice_h4_span']}\">(placed on "
                    . date('F j,Y g:ia', strtotime($order->created_at)) . ")</span></h4>";
        
        $htmlContent.= "<table width=\"100%\" border=\"0\"><tr>";        
        $htmlContent.= "<td valign=\"top\">";
        $htmlContent.=  "<h5>Billing Info &amp; Payment Method</h5>";
        $htmlContent.=      "<p><strong>{$order->billing_firstname} {$order->billing_lastname}</strong></p>";
        $htmlContent.=      "<p>{$order->billing_line1} - {$order->billing_line2}<br/>";
        $htmlContent.=          "{$order->billing_city}, {$order->billing_state_code} {$order->billing_zip}<br/>";
        $htmlContent.=          "{$order->billing_country}<br/>";
        $htmlContent.=          "T: {$order->billing_phone}";
        $htmlContent.=      "</p>";
        $htmlContent.= "</td>";                
        $htmlContent.= "<td valign=\"top\">";
        $htmlContent.=  "<h5 width=\"60%\">Shipping Info &amp; Method</h5>";
        $htmlContent.=      "<p><strong>{$order->shipping_firstname} {$order->shipping_lastname}</strong></p>";
        $htmlContent.=      "<p>{$order->shipping_line1} - {$order->shipping_line2}<br/>";
        $htmlContent.=          "{$order->shipping_city}, {$order->shipping_state_code} {$order->shipping_zip}<br/>";
        $htmlContent.=          "{$order->shipping_country}<br/>";
        $htmlContent.=          "T: {$order->shipping_phone}";
        $htmlContent.=      "</p>";
        
        if ($order->status == Order::STATUS_DELIVERING) {
            $agent = 'Unknown Delivery Agent';
            if ($order->shipping_agent == Order::SHIPPING_UPS) $agent = 'UPS';
            else if ($order->shipping_agent == Order::SHIPPING_USPS) $agent = 'USPS';                             
            else if ($order->shipping_agent == Order::SHIPPING_FEDEX) $agent = 'FedEx';
            $htmlContent.=  "<p>Shipping Agent <strong>$agent</strong><br />Tracking <strong>#{$order->tracking_number}</strong></p>";                
        }
        
        $htmlContent.= "</td>";                
        $htmlContent.= "</tr></table>";                        
        
        $htmlContent.= $this->htmlInvoiceOrderItems($order);            
        
        return $htmlContent;
    }
    
    private function htmlInvoiceOrderItems($order) {
        
        //$htmlContent= '<table style="width:100%;border-collapse:collapse;border:1px solid #ddd;margin-top: 3em;" cellpadding="8" cellspacing="0">';
        $htmlContent= '<table style="width:100%;border:1px solid #ddd;margin-top: 3em;" cellpadding="8" cellspacing="0">';
        //$htmlContent.= '<tr style="font-size:10pt;box-shadow:inset 0 -.5em 1em rgba(0,0,0,.3);">';        
        $htmlContent.= '<tr style="font-size:10pt;">';        
        $htmlContent.= '<th style="text-align:left;border: 1px solid #ddd;">ITEM</th>';
        $htmlContent.= '<th style="text-align:center;border: 1px solid #ddd;">COLOR</th>';
        $htmlContent.= '<th style="text-align:center;border: 1px solid #ddd;">QTY</th>';
        $htmlContent.= '<th style="text-align:right;border: 1px solid #ddd;">PRICE</th>';
        $htmlContent.= '</tr>';

        $even = true;
        $subtotal = 0;
        foreach($order->items as $item)
        {
            $even = !$even;             
            if (!$even) $htmlContent.= '<tr style="background:#fff;">';
            else $htmlContent.= '<tr style="background:#eee;">';            
            
            $image = ProductImage::model()->findByPk($item->product->main_image_id);
            $image_path = ($image !== null)? $_SERVER['SERVER_NAME'] . Yii::app()->params['productImagesPath'] . $image->path_thumbnail : $_SERVER['SERVER_NAME'] . '/images/transparent.png';            
                        
            $htmlContent.= '<td>';            
            //$htmlContent.=     '<p>';
            $htmlContent.=        '<img align="middle" width="50" src="http://'. $image_path. '" alt="" />&nbsp;' . $item->product->name;
            //$htmlContent.=     '</p>';
            $htmlContent.= '</td>';
            
            $htmlContent.= '<td style="text-align:center;">';                        
            if ($color = Color::model()->findByPk($item->color_id)) {
                $htmlContent.= '<span style="background:'. $color->value .';display:inline-block;width:1em;height:1em;"></span>';
            }
            $htmlContent.= '</td>';
            
            $htmlContent.= '<td style="text-align:center;"><span style="font-size:1em;">'. $item->quantity. '</span></td>';
            $htmlContent.= '<td style="text-align:right;"><span style="font-size:1em;">$'. number_format($item->product->price * $item->quantity, 2).'</span></td>';
        
            $htmlContent.= '</tr>';
            $subtotal += $item->product->price * $item->quantity;
        }
        
        $off = $subtotal - $order->amount + $order->shipping_amount;
        
        $htmlContent.= '<tr style="border-top: 1px solid #ddd;">';
        $htmlContent.=  '<td colspan="2">&nbsp;</td>';
        $htmlContent.=  '<td style="text-align:right;">Subtotal: </td>';
        //$htmlContent.=  '<td style="text-align:right;"><span style="color:#000;font-size:1em;">$' .number_format($order->amount - $order->shipping_amount, 2) .'</span></td>';
        $htmlContent.=  '<td style="text-align:right;"><span style="color:#000;font-size:1em;">$' .number_format($subtotal, 2) .'</span></td>';
        $htmlContent.= '</tr>';
        
        if ($order->promo_id) {
            $htmlContent.= '<tr>';
            $htmlContent.=  '<td colspan="2">&nbsp;</td>';
            $htmlContent.=  '<td style="text-align:right;">Order Off: </td>';
            $htmlContent.=  '<td style="text-align:right;"><span style="color:#000;font-size:1em;">-$' .number_format($off, 2) .'</span></td>';
            $htmlContent.= '</tr>';
        }
        
        $htmlContent.= '<tr>';
        $htmlContent.=  '<td colspan="2">&nbsp;</td>';
        $htmlContent.=  '<td style="text-align:right;">Shipping: </td>';
        $htmlContent.=  '<td style="text-align:right;"><span style="color:#000;font-size:1em;">$' .number_format($order->shipping_amount, 2) .'</span></td>';
        $htmlContent.= '</tr>';
        
        $htmlContent.= '<tr style="border-top: 1px solid #ddd;">';
        $htmlContent.=  '<td colspan="2">&nbsp;</td>';
        $htmlContent.=  '<td style="text-align:right;"><p><strong>Total: </strong></p></td>';
        $htmlContent.=  '<td style="text-align:right;"><strong style="color:#000;font-size:1em;">$' .number_format($order->amount, 2) .'</strong></td>';
        $htmlContent.= '</tr>';                                                         

        $htmlContent .='</table>';

        return $htmlContent;
    }
    
    private function plainInvoice($order) {
        $plainContent = "Hi {$this->_userName}\n\n";
        $plainContent.= "Thank you for your order from {$this->_host}.\n";
        if ($order->status == Order::STATUS_PAID) {
            $plainContent.= "Once your package ships, we will send you an email with a link to track it.\n";
            $plainContent.= "You may also check out your {$this->_host} account to track the status of your order.\n";
        } elseif ($order->status == Order::STATUS_DELIVERING) {
            $plainContent.= "You may check out your {$this->_host} account to track the status of your order.\n";
        }        
        $plainContent.= "If you have any questions about your order please contact us at info@rumordeals.com.\n";
        $plainContent.= "Thank you again for your business. We hope your order arrives quickly and safely.\n\n";
        $plainContent.= "Thank you again for your business.";
         if ($order->status == Order::STATUS_DELIVERING ||$order->status == Order::STATUS_PAID) {
            $plainContent.= " We hope your order arrives quickly and safely.\n\n";                
        } else {
            $plainContent.= "\n\n";
        }
        
        $plainContent.= "Order #{$order->id} (placed on ". date('F j,Y g:ia', strtotime($order->created_at)) . ")\n\n";
        
        $plainContent.= "Billing Info & Payment Method:\n";
        $plainContent.= "------------------------------\n";
        $plainContent.= $order->billing_firstname . ' ' . $order->billing_lastname . "\n";
        $plainContent.= $order->billing_line1 . ' - ' . $order->billing_line2 . "\n";
        $plainContent.=  $order->billing_city . ', ' . $order->billing_state_code . ' ' . $order->billing_zip . "\n";
        $plainContent.=  $order->billing_country . "\n";
        $plainContent.=  "T: " . $order->billing_phone. "\n\n";
        
        $plainContent.= "Shipping Info & Method:\n";
        $plainContent.= "------------------------------\n";
        $method = 'Unknown';
        if ($order->shipping_method == Order::SHIPPING_STANDARD) $method =  'Standard';
        else if ($order->shipping_method == Order::SHIPPING_EXPEDITED) $method = 'Expedited';
        else if ($order->shipping_method == Order::SHIPPING_EXPRESS) $method = 'Express';
        $plainContent.= "Method: $method\n";
        
        if ($order->status == Order::STATUS_DELIVERING) {
            $agent = 'Unknown Delivery Agent';
            if ($order->shipping_agent == Order::SHIPPING_UPS) $agent = 'UPS';
            else if ($order->shipping_agent == Order::SHIPPING_USPS) $agent = 'USPS';                 
            $plainContent.= " Agent: $agent, tracking #{$order->tracking_number}.\n";
        }
        
        $plainContent.= "\n" . $order->shipping_firstname . ' ' . $order->shipping_lastname . "\n";
        $plainContent.= $order->shipping_line1 . ' - ' . $order->shipping_line2 . "\n";
        $plainContent.=  $order->shipping_city . ', ' . $order->shipping_state_code . ' ' . $order->shipping_zip . "\n";
        $plainContent.=  $order->shipping_country . "\n";
        $plainContent.=  "T: " . $order->shipping_phone. "\n\n";
        
        $plainContent.= "Order Items:\n";
        $plainContent.= "------------------------------\n";
        $subtotal = 0;
        foreach($order->items as $item) {
            $plainContent.= "    Name: " . $item->product->name . "\n";
            $plainContent.= "     SKU: #" . $item->sku . "\n";
            $color = Color::model()->findByPk($item->color_id);
            if ($color !==null){
            $plainContent.= "  Colour: " . $color->value . "\n";;
            }
            $plainContent.= "Quantity: " . $item->quantity . "\n";
            $plainContent.= "   Price: $" . number_format($item->product->price, 2) . "\n";
            $plainContent.= "   Total: $" . number_format($item->product->price * $item->quantity, 2) . "\n\n";
            $subtotal += $item->product->price * $item->quantity;
        }
        $plainContent.= "------------------------------\n";
        
        $off = $subtotal - $order->amount + $order->shipping_amount;
        //$plainContent.= "Order Subtotal: $" . number_format($order->amount - $order->shipping_amount,2) . "\n";
        $plainContent.= "Order Subtotal: $" . number_format($subtotal,2) . "\n";
        if ($order->promo_id) $plainContent.= "     Order Off: -$" . number_format($off,2) . "\n";
        //$plainContent.= "     Order Off: -$" . number_format($off,2) . "\n";
        $plainContent.= "Order Shipping: $" . number_format($order->shipping_amount,2) . "\n";
        $plainContent.= "   Order Total: $" . number_format($order->amount,2) . "\n\n";
        return $plainContent;
    }


    public function orderPlaced($user_email, $order_id)
    {
        $order = Order::model()->findByPk($order_id);
        if ($order===null) return false;
        
        if (!$this->prepareUser($user_email, self::USER_SUBSCRIBED)) return false;
        
        $plainContent = "Hi {$this->_userName}\n\n";
        $plainContent.= "Thank you for shopping at {$this->_host}.\n";
        $plainContent.= "We will get to work on your order right away and ";
        $plainContent.= "send you an email as soon as it is shipped with a link to track it.\n";
        $plainContent.= "You may also check out your {$this->_host} ";
        $plainContent.= "account to track the status of your order.\nIf you have any questions about your order please contact us at ";
        $plainContent.= "info@rumordeals.com.\n";        
        $plainContent.= "Thank you again for your business. We hope your order arrives quickly and safely.\n\n";
        $plainContent.= "Sincerely, {$this->_host}\n";
        
        $htmlContent = "<h1 style=\"{$this->_style['greeting']}\">Hi <strong>{$this->_userName}</strong></h1>\n";
        $htmlContent.= "<p>Thank you for shopping at <a href=\"http://{$this->_host}\" style=\"{$this->_style['content_link']}\">{$this->_host}</a>.</p>\n";
        $htmlContent.= "<p>We will get to work on your order right away and send you an email as soon as it is shipped with a link to track it. ";
        $htmlContent.= "You may also check out your <a href=\"http://{$this->_host}\" style=\"{$this->_style['content_link']}\">{$this->_host}</a> ";
        $htmlContent.= "account to track the status of your order. If you have any questions about your order please contact us at ";        
        $htmlContent.= "<a href=\"mailto:info@rumordeals.com\" style=\"{$this->_style['content_link']}\">info@rumordeals.com</a>.</p>";
        $htmlContent.= "<p>Thank you again for your business. We hope your order arrives quickly and safely.</p>\n";                
        $htmlContent.= "<p>Sincerely,<br /><a href=\"http://{$this->_host}\" style=\"{$this->_style['content_link']}\">" . Yii::app()->name. "</a></p>";	    
        
        $subject    = "Order confirmation #$order_id";
        $params = array('title' => "Order confirmation<br/><strong>#$order_id</strong>");
        
        if (!$this->prepareLetter($plainContent, $htmlContent, $subject, $params)) return false;        
        return $this->sendMultipartMail();
    }
    
    public function orderStatusChanged($user_email, $order_id)
    {
        if (!$this->prepareUser($user_email, self::USER_SUBSCRIBED)) return false;
        
        $plainContent = '';
        $htmlContent = '';
        $subject = '';
        
        if (!$this->prepareLetter($plainContent, $htmlContent, $subject)) return false;        
        return $this->sendMultipartMail();
    }
    
    public function userSubscribed($user_email)
    {
        if (!$this->prepareUser($user_email, self::USER_SUBSCRIBED)) return false;
        
        $plainContent = '';
        $htmlContent = '';
        $subject = '';
        
        if (!$this->prepareLetter($plainContent, $htmlContent, $subject)) return false;        
        return $this->sendMultipartMail();
    }
    
    public function sendNewsletter($user_email)
    {
        if (!$this->prepareUser($user_email, self::USER_SUBSCRIBED)) return false;
        
        $plainContent = '';
        $htmlContent = '';
        $subject = '';
        
        if (!$this->prepareLetter($plainContent, $htmlContent, $subject)) return false;        
        return $this->sendMultipartMail();
    }
    
    /*----- PRIVATE FUNCTIONS ---------------------------------------------------------*/    
    private function prepareUser($user_email, $user_type) {
        $this->_host = $_SERVER['SERVER_NAME'];
        $this->_to   = $user_email;        
        
        $this->createStyleSheet();
        
        switch ($user_type) {
            case self::USER_SIGNED_UP:
                $this->_user = User::model()->findByAttributes(array('email'=>$user_email));
                if ($this->_user === null) return false;
                $this->_userName = ucfirst(strtolower($this->_user->first_name));                
                break;
            case self::USER_SUBSCRIBED:
                $subscriber = Subscriber::model()->findByAttributes(array('email'=>$user_email));
                if ($subscriber === null) return false;
                break;
            case self::USER_GUEST:                
                break;
            default:
                return false;
        }                
        
        return true;
    }
    
    private function prepareLetter($plainContent, $htmlContent, $subject, $params = null) {                          
        
        $this->_from    = Yii::app()->params['adminEmail'];           
        $this->_subject = $subject;
        
        $this->_htmlText = $this->header($params);
        $this->_htmlText.= $htmlContent;
        //$this->_htmlText.= $this->footer($params);
        
        $this->_plainText = $plainContent;                
        
        return true;
    }

        private function sendMultipartMail()
    {
        $boundary = md5(Yii::app()->name);
        
        $headers = array();
        $headers[] = "MIME-Version: 1.0";
        $headers[] = "Content-type: multipart/alternative; boundary=\"$boundary\"";
        $headers[] = "From: {$this->_from}";
        
        $msg_body  = "This is a multipart message in MIME format.\n";                
        
        $msg_body .= "--$boundary\n";
        $msg_body .= "Content-Type: text/plain; charset=utf-8\n";
        $msg_body .= "Content-Transfer-Encoding: 7bit\n\n";
        $msg_body .= "{$this->_plainText}\n\n";
        
        $msg_body .= "--$boundary\n";
        $msg_body .= "Content-Type: text/html; charset=utf-8\n";
        $msg_body .= "Content-Transfer-Encoding: 7bit\n\n";        
        $msg_body .= "{$this->_htmlText}\n\n";
        
        $msg_body .= "--$boundary--\n";

        return mail($this->_to, $this->_subject, $msg_body, join("\r\n", $headers));
    }
       
    private function header($params = null) {                
        $title = isset($params['title'])? $params['title'] : Yii::app()->name;
        
        $header = "<!DOCTYPE html>\n";        
        $header= "<html>\n";
        $header.= "<head>\n";
 
        $header.= "<meta charset=\"utf-8\">\n";
        $header.= "<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\">\n";
        $header.= "<meta name=\"description\" content=\"\">\n";
        $header.= "<meta name=\"viewport\" content=\"width=device-width\">\n";        
        $header.= "<title>" . strip_tags($title) . "</title>\n";                                
        $header.= "</head>\n";
        
        $header.= "<body style=\"{$this->_style['body']}\">\n";
        $header.= "<table width=\"640\" align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"{$this->_style['page']}\">\n";        
        $header.=   "<tr height=\"153px\" style=\"{$this->_style['header_row']}\">\n";
        $header.=       "<td style=\"{$this->_style['header']}\">\n";
        $header.=           "<h1 style=\"{$this->_style['title']}\">$title</h1>";
        $header.=       "</td>\n";
        $header.=   "</tr>\n";
        $header.=   "<tr>\n";
        $header.=       "<td style=\"{$this->_style['content']}\">\n";
        
        
        return $header;
    }
    
    private function footer($params = null) {    
        $fbicon   = 'http://' . $_SERVER['SERVER_NAME'] . '/images/emails/fb-ico.png';
        $twicon   = 'http://' . $_SERVER['SERVER_NAME'] . '/images/emails/tw-ico.png';
        $footlogo = 'http://' . $_SERVER['SERVER_NAME'] . '/images/emails/foot-logo.png';
        
        $footer = "</td></tr>\n";
        $footer.= "<tr style=\"{$this->_style['footer_row']}\"><td style=\"{$this->_style['footer']}\">";
        
        $footer.= "<div>";
        $footer.= "<table width=\"100%\" align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr>";
        $footer.= $this->printCategory('__shop_mobile');
        $footer.= $this->printCategory('__shop_audio');
        $footer.= $this->printCategory('__shop_gaming');
        $footer.= "</tr></table>";
        $footer.= "</div>";
        
        $footer.= "<table width=\"100%\" align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"{$this->_style['footer_bottom']}\"><tr>";
        $footer.= "<td width=\"18%\"></td>";
        $footer.= "<td width=\"70%\">";
        $footer.= "<p>Follow us on:";
        $footer.= "<a href=\"https://facebook.com/rumordeals\" style=\"{$this->_style['social']}\"><img src=\"$fbicon\" alt=\"\"></a>";
        $footer.= "<a href=\"http://twitter.com/rumordeals\" style=\"{$this->_style['social']}\"><img src=\"$twicon\" alt=\"\"></a>";
        $footer.= "</p>";
        $footer.= "</td>";
        $footer.= "<td align=\"right\">";
        $footer.= "<a href=\"http://{$this->_host}\"><img src=\"$footlogo\" alt=\"\" width=\"61\" height=\"78\"></a>";
        $footer.= "</td>";
        $footer.= "</tr></table>";
        
        $footer.= '</td></tr></table>';        
        $footer.= '</body>';
        $footer.= '</html>';
        
        return $footer;
    }


    private function createStyleSheet() {
        
        $this->_style = array();
        $this->_style['body'] = 'margin:0;color:#5c5c5c;line-height:1.5em;';        
        $this->_style['page'] = '';        
        $this->_style['header_row'] = '';
        
        $this->_style['greeting'] = 'color:#5c5c5c;font-family:\'Proxima Nova\',Proxima Nova;font-size:1.5em;font-weight: normal;';
        $this->_style['title'] = 'width:100%;font-family:\'Proxima Nova\',Proxima Nova;font-size:1.5em;font-weight:normal;text-transform:uppercase;text-align:center;margin:0;padding:0;float:right;';
        //$this->_style['header'] = "background: url(http://" . $this->_host . '/images/emails/bg-head.png) no-repeat left;';        
        $this->_style['content'] = 'color:#5c5c5c;padding:1em 2em; margin-bottom:3em;font-family:\'Proxima Nova\',Proxima Nova;font-size:1.1em;';
        $this->_style['content_link'] = 'color:#5c5c5c;';
        
        $this->_style['footer'] = "background:#f2f3f3 url(http://" . $this->_host . '/images/emails/bg-footer.png) repeat-x left top;border-top:1px solid #f7f7f7; padding:1em 2em; margin-bottom:3em;font-family:\'Proxima Nova\',Proxima Nova;font-size:1.2em;';
        $this->_style['footer_row'] = '';
        $this->_style['footer_column'] = 'vertical-align:top;margin-left:20px;font-family:\'Proxima Nova\',Proxima Nova;font-size:10pt;';
        $this->_style['footer_column_name'] = 'color:#EE1C4E;text-transform:uppercase;font-size:12pt;';
        $this->_style['footer_category_list'] = 'list-style:none;margin:0;padding:0;';
        $this->_style['footer_category_link'] = 'color:#5c5c5c;text-decoration:none;margin:0;padding:0;';
        $this->_style['footer_category_item'] = 'margin:0;padding:0;';
        
        $this->_style['social'] = "padding:.5em 1em 2em;text-decoration:none;outline:none;position:relative;background:url(http://" . $this->_host . '/images/emails/shadow-social.png) 0 1.8em no-repeat;';
        $this->_style['footer_bottom'] = 'margin-top: 2em;';
        
        $this->_style['invoice_h4'] = 'font-family:\'Proxima Nova\',Proxima Nova;font-weight:normal;text-transform:uppercase;border-bottom:1px solid #ddd;color:#000;font-size:1.1em; margin-bottom: 3em;';
        $this->_style['invoice_h4_i'] = 'color:#EE1C4E;font-weight:normal;';
        $this->_style['invoice_h4_span'] = 'font-family:\'Proxima Nova\',Proxima Nova;text-transform:none;width:50%;float:right;color:#5c5c5c;font-size:11pt;';
        
    }
    
     private function buildFooterCategory($tag) {                          
        $this->_node = Category::model()->findByAttributes(array('tag'=>$tag));
        if ($this->_node)
        {            
            $this->_nodeChildren = Category::model()->findAllByAttributes(
                   array('parent_id'=>$this->_node->id, 'is_published'=>'yes'));
        }        
    }
    
    
    private function printCategory($tag) {
        $this->buildFooterCategory($tag);
        $str = "<td valign=\"top\" style=\"{$this->_style['footer_column']}\">";
        $str.=      "<h3 style=\"{$this->_style['footer_column_name']}\">{$this->_node->name}</h3>";
        $str.=      "<ul style=\"{$this->_style['footer_category_list']}\">";
        foreach($this->_nodeChildren as $child) {
                $str .= "<li style=\"{$this->_style['footer_category_item']}\">";
                $str .= "<a style=\"{$this->_style['footer_category_link']}\" href=\"http://" . $_SERVER['SERVER_NAME']
                                            . '/' . $child->parent->slug . '/' . $child->slug . '">' . $child->name .'</a></li>';                                
        }
        $str .= "</ul></td>";
        return $str;
    }
    
    public function instantQuote($quote)
    {
         
        $this->_from = $quote['User']['email'];
        $this->_to = Yii::app()->params['quoteEmail'];
        $this->_subject = 'Quote';
        
        $plainContent = "Product Quote\n\n";
        $plainContent.= "Customer: ".$quote['User']['first_name'].' '
                                    .$quote['User']['last_name']
                                    .' ('.$quote['User']['email'].")\n";
        $plainContent.= "Company: ".$quote['User']['company']."\n";
        $plainContent.= "Phone: ".$quote['User']['phone']."\n";
        $plainContent.= "Membership: ".$quote['membership']."\n";
        $plainContent.= "Quantity: " . $quote['Quantity'] . "\n";
        $plainContent.= "Product Model: " . $quote['Product']['model_number'] . "\n\n";
        $plainContent.= "\n\nComment:\n" . $quote['comment'] . "\n\n";
                
        $htmlContent = "<h1>Product Quote</h1>\n";                
        $htmlContent = "<p>\n";                
        $htmlContent.= "<b>Customer:</b> ".$quote['User']['first_name'].' '
                                    .$quote['User']['last_name']
                                    .' ('.$quote['User']['email'].")</br>";
        $htmlContent.= "<b>Company:</b> ".$quote['User']['company']."</br>";
        $htmlContent.= "<b>Phone:</b> ".$quote['User']['phone']."</br>";
        $htmlContent.= "<b>Membership:</b> ".$quote['membership']."</br>";
        $htmlContent.= "<b>Quantity:</b> " . $quote['Quantity'] . "</br>";                
        $htmlContent.= "<b>Product Model:</b> " . $quote['Product']['model_number'] . "</br>";                
        $htmlContent.= "</br><b>Comment:</b></br>" . $quote['comment'] . "</p>\n\n";
                
        $this->_plainText = $plainContent;
        $this->_htmlText = $htmlContent;

        return $this->sendMultipartMail();
    }
    
    public function contactMessage($contact)
    {
         
        $this->_from = $contact->email;
        $this->_to = Yii::app()->params['contactEmail'];
        $this->_subject = 'Customer Question';
        
        $plainContent = "Customer Question\n\n";
        $plainContent.= "Customer: ".$contact->first_name.' '
                                    .$contact->last_name.' '
                                    .' ('.$contact->email.")\n";
        $plainContent.= "Company: ".$contact->company."\n";
        $plainContent.= "Phone: ".$contact->phone."\n";
        $plainContent.= "Message: \n".$contact->message."\n\n";       
                
        $htmlContent = "<h1>Customer Question</h1>\n";                
        $htmlContent = "<p>\n";                
        $htmlContent.= "<b>Customer:</b> ".$contact->first_name.' '
                                    .$contact->last_name
                                    .' ('.$contact->email.")</br>";
        $htmlContent.= "<b>Company:</b> ".$contact->company."</br>";
        $htmlContent.= "<b>Phone:</b> ".$contact->phone."</br>";        
        $htmlContent.= "</br><b>Message:</b></br>" . $contact->message . "</p>\n\n";
                
        $this->_plainText = $plainContent;
        $this->_htmlText = $htmlContent;

        return $this->sendMultipartMail();
    }
    
     
}

?>
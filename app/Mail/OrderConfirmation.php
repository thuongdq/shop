<?php

namespace App\Mail;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class orderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $order;
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
//        return $this->markdown('emails.order-confirmation')
//            ->subject('Đơn hàng của bạn đã được chấp nhận')
//            ->with([
//                'order' => $this->order,
//                'products' => $this->order->products
//            ]);
        return $this->markdown('emails.order-confirmation')
            ->subject('Đơn hàng của bạn đã được chấp nhận')
            ->with([
                'order' => $this->order,
                'products' => $this->order->products
            ]);
    }
}

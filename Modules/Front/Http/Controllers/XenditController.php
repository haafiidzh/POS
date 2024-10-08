<?php

namespace Modules\Front\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ECommerce\Models\Order;
use Modules\Common\Contracts\JsonResponse;
use Modules\ECommerce\Services\Repositories\OrderRepo;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class XenditController extends Controller
{
    use JsonResponse;

    /**
     * Recieve invoice webhook from xendit
     *
     * @param  Request $request
     * @return Response
     */
    public function invoiceCallback(Request $request)
    {
        $order = Order::where('order_code', $request->external_id)->first();

        try {
            if (!$order) {
                throw new ModelNotFoundException('Sorry, we cannot find any invoice data.', 404);
            }

            (new OrderRepo)->updateFromPendingOrder($order, $request->toArray());

            // Return success response
            return $this->success(
                'Invoice updated successfully.',
                $request->all()
            );
        } catch (Exception $exception) {
            $log = createLog('callback_failed');
            $log->error($exception);

            return $this->error(
                'Failed to update invoice data.',
                $exception,
            );
        }
    }
}

<?php

use App\Models\ActivityLog;

if (!function_exists('log_activity')) {
    /**
     * Ghi log hoạt động của khách hàng
     *
     * @param  \App\Models\Customer|int|null $customer
     * @param  string $action
     * @param  string|null $description
     * @param  array $meta
     * @return \App\Models\ActivityLog
     */
    function log_activity($customer, string $action, ?string $description = null, array $meta = [])
    {
        if (is_object($customer)) {
            $customer_id = $customer->id;
            $customer_name = $customer->name ?? null;
        } else {
            $customer_id = $customer;
            $customer_name = null;
        }

        return ActivityLog::create([
            'customer_id'   => $customer_id,
            'customer_name' => $customer_name,
            'action'        => $action,
            'description'   => $description,
            'file_name'     => $meta['file_name'] ?? null,
            'file_path'     => $meta['file_path'] ?? null
        ]);
    }
}

<div>
    <div class="row align-items-center justify-content-between mb-4">
        <div class="col">
            <h5 class="fw-500 text-white">{{ $lang->data['order_details'] ?? 'Order Details' }}</h5>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.view_orders') }}" class="btn btn-icon btn-3 btn-white text-primary mb-0">
                <i class="fa fa-arrow-left me-2"></i> {{ $lang->data['back'] ?? 'Back' }}
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9">
            <div class="card mb-4">
                <div class="card-header p-4">
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="text-uppercase fw-500">{{ $sitename }}</h5>
                            <p class="text-sm mb-0">{{ $phone }}</p>
                            <p class="text-sm mb-0">{{ $store_email }}</p>
                            <p class="text-sm mb-3">{{ $address }} - {{ $zipcode }}</p>
                            <p class="text-sm mb-0 text-uppercase"> {{ $lang->data['tax'] ?? 'TAX' }}:
                                {{ $tax_number }}</p>
                        </div>
                        <div class="col-auto mt-4">
                            <h6 class="text-uppercase fw-500">
                                <span> {{ $lang->data['order_id'] ?? 'Order ID' }}:</span>
                                <span class="ms-2 fw-600">#{{ $order->order_number }}</span>
                            </h6>
                            <p class="text-sm mb-1">
                                <span> {{ $lang->data['order_date'] ?? 'Order Date' }}:</span>
                                <span
                                    class="fw-600 ms-2">{{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y') }}</span>
                            </p>
                            <p class="text-sm mb-3">
                                <span> {{ $lang->data['delivery_date'] ?? 'Delivery Date' }}:</span>
                                <span
                                    class="fw-600 ms-2">{{ \Carbon\Carbon::parse($order->delivery_date)->format('d/m/Y') }}</span>
                            </p>
                            <div class="d-flex align-items-center">
                                <div><span class="text-sm">
                                        {{ $lang->data['order_status'] ?? 'Order Status' }}:</span></div>
                                <div class="dropdown ms-2">
                                    <button class="btn btn-xs bg-secondary dropdown-toggle mb-0 text-white"
                                        type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        {{ getOrderStatus($order->status) }}
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li><a class="dropdown-item" href="#"
                                                wire:click.prevent="changeStatus(1)">{{ $lang->data['processing'] ?? 'Processing' }}</a>
                                        </li>
                                        <li><a class="dropdown-item" href="#"
                                                wire:click.prevent="changeStatus(2)">{{ $lang->data['ready_to_deliver'] ?? 'Ready To Deliver' }}</a>
                                        </li>
                                        <li><a class="dropdown-item" href="#"
                                                wire:click.prevent="changeStatus(3)">{{ $lang->data['delivered'] ?? 'Delivered' }}</a>
                                        </li>
                                        <li><a class="dropdown-item" href="#"
                                                wire:click.prevent="changeStatus(4)">{{ $lang->data['returned'] ?? 'Returned' }}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="text-uppercase text-secondary text-xs opacity-7">#</th>
                                    <th class="text-uppercase text-secondary text-xs opacity-7">
                                        {{ $lang->data['service_name'] ?? 'Service Name' }}</th>
                                    <th class="text-uppercase text-secondary text-xs opacity-7">
                                        {{ $lang->data['color'] ?? 'Color' }}</th>
                                    <th class="text-uppercase text-secondary text-xs opacity-7">
                                        {{ $lang->data['rate'] ?? 'Rate' }}</th>
                                    <th class="text-center text-uppercase text-secondary text-xs  opacity-7">
                                        {{ $lang->data['qty'] ?? 'QTY' }}</th>
                                    <th class="text-uppercase text-secondary text-xs opacity-7">
                                        {{ $lang->data['total'] ?? 'Total' }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderdetails as $item)
                                    @php
                                        $service = \App\Models\Service::where('id', $item->service_id)->first();
                                    @endphp
                                    <tr>
                                        <td>
                                            <p class="text-sm px-3 mb-0">{{ $loop->index + 1 }}</p>
                                        </td>
                                        <td>
                                            <div class="d-flex px-3 py-1">
                                                <div>
                                                    <img src="{{ asset('assets/img/service-icons/' . $service->icon) }}"
                                                        class="avatar avatar-sm me-3">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-1 text-sm">{{ $service->service_name }}</h6>
                                                    <span
                                                        class="text-xs fw-600 text-primary">[{{ $item->service_name }}]</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4">
                                            @if($item->color_code!="")
                                                <button class="btn" style="background-color: {{$item->color_code}}">
                                                </button>
                                            @endif
                                        </td>
                                        <td class="">
                                            <p class="text-sm px-3 mb-0">{{ getCurrency() }}
                                                {{ number_format($item->service_price, 2) }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <p class="text-sm px-3 mb-0">{{ $item->service_quantity }}</p>
                                        </td>
                                        <td class="">
                                            <p class="text-sm px-3 mb-0">{{ getCurrency() }}
                                                {{ number_format($item->service_detail_total, 2) }}</p>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr class="mb-0 mt-0 bg-secondary">
                <div class="card-footer px-4">
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <h6 class="mb-2 fw-500">{{ $lang->data['invoice_to'] ?? 'Invoice To' }}:</h6>
                            <h6 class="mb-1 fw-500 text-sm">{{ $customer->name ?? 'Walk-In Customer' }}</h6>
                            <p class="text-sm mb-0">{{ $customer->phone ?? 'Phone' }}</p>
                            <p class="text-sm mb-0">{{ $customer->email ?? 'Email' }}</p>
                            <p class="text-sm mb-3">{{ $customer->address ?? 'Customer' }}</p>
                            <p class="text-sm mb-0">{{ $lang->data['vat'] ?? 'VAT' }}:
                                {{ $customer->tax_number ?? 'TAX' }}</p>
                        </div>
                        <div class="col-md-4 mb-3">
                            <h6 class="fw-500 mb-2">{{ $lang->data['payment_details'] ?? 'Payment Details' }}:
                            </h6>
                            <div class="">
                                <div class="row mb-50 align-items-center">
                                    <div class="col text-sm">{{ $lang->data['sub_total'] ?? 'Sub Total' }}:</div>
                                    <div class="col-auto text-sm">{{ getCurrency() }}
                                        {{ number_format($order->sub_total, 2) }}</div>
                                </div>
                                <div class="row mb-50 align-items-center">
                                    <div class="col text-sm">{{ $lang->data['addon'] ?? 'Addon' }}:</div>
                                    <div class="col-auto text-sm">{{ getCurrency() }}
                                        {{ number_format($order->addon_total, 2) }}</div>
                                </div>
                                <div class="row mb-50 align-items-center">
                                    <div class="col text-sm">{{ $lang->data['discount'] ?? 'Discount' }}:</div>
                                    <div class="col-auto text-sm">{{ getCurrency() }}
                                        {{ number_format($order->discount, 2) }}</div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <div class="col text-sm">{{ $lang->data['tax'] ?? 'Tax' }}
                                        ({{ $order->tax_percentage }}%):</div>
                                    <div class="col-auto text-sm">{{ getCurrency() }}
                                        {{ number_format($order->tax_amount, 2) }}</div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col text-sm fw-600">
                                        {{ $lang->data['gross_total'] ?? 'Gross Total' }}:
                                    </div>
                                    <div class="col-auto text-sm text-dark fw-600">{{ getCurrency() }}
                                        {{ number_format($order->total, 2) }}</div>
                                </div>
                            </div>
                        </div>
                        <hr class="bg-secondary">
                        <div class="col-md-1">
                            <h6 class="mb-2 text-sm fw-500">{{ $lang->data['notes'] ?? 'Notes' }}:</h6>
                        </div>
                        <div class="col-md-11">
                            <p class="text-sm mb-0">{{ $order->note }}</p>
                        </div>
                        <div class="mt-4 position-relative text-center">
                            <p class="text-sm fw-500 mb-2 text-secondary text-border d-inline z-index-2 bg-white px-3">
                                Powered by <a href="{{url('/')}}" class="text-dark fw-600" target="_blank">{{ getApplicationName() }}</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card mb-4">
                <div class="card-body p-4">
                    @if ($orderaddons)
                        @if (count($orderaddons) > 0)
                            <h6 class="mb-3 fw-500 mt-2">{{ $lang->data['service_addons'] ?? 'Service Addons' }}</h6>
                            <ul class="list-group">
                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                    <div class="d-flex flex-column">
                                        @foreach ($orderaddons as $item)
                                            <span class="mb-3 text-sm">
                                                <span class="fw-500">{{ $item->addon_name }}:</span>
                                                <span class="text-sm ms-2">{{ getCurrency() }}
                                                    {{ number_format($item->addon_price, 2) }}</span>
                                            </span>
                                        @endforeach
                                    </div>
                                </li>
                            </ul>
                        @endif
                    @endif
                    <h6 class="mb-3 fw-500 mt-2">{{ $lang->data['payments'] ?? 'Payments' }}</h6>
                    <div class="timeline timeline-one-side">
                        @foreach ($payments as $item)
                            <div class="timeline-block mb-3">
                                <span class="timeline-step">
                                    <i class="fa fa-dot-circle-o text-secondary"></i>
                                </span>
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">{{ getCurrency() }}
                                        {{ number_format($item->received_amount, 2) }}</h6>
                                    <p class="text-secondary text-xs mt-1 mb-0">
                                        <span>{{ Carbon\Carbon::parse($item->payment_date)->format('d/m/Y') }}</span>
                                        <span
                                            class="ms-2 fw-600 text-uppercase">[{{ getpaymentMode($item->payment_type) }}]</span>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        @if ($balance > 0)
                            @if($order->status != 4)
                            <div class="col-12">
                                <a data-bs-toggle="modal" data-bs-target="#addpayment" type="button"
                                    class="badge badge-success mb-3 w-100 py-3 fw-600">
                                    {{ $lang->data['add_payment'] ?? 'Add Payment' }}
                                </a>
                            </div>
                            @endif
                        @else
                            <div class="col-12">
                                <a type="button" class="badge badge-light disabled mb-3 w-100 py-3 fw-600">
                                    {{ $lang->data['fully_paid'] ?? 'Fully Paid' }}
                                </a>
                            </div>
                        @endif
                        <div class="col-12">
                            <a href="{{ url('admin/orders/print-order/' . $order->id) }}" target="_blank"
                                type="button" class="btn btn-icon btn-warning mb-0 w-100">
                                {{ $lang->data['print_invoice'] ?? 'Print Invoice' }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade " id="image" tabindex="-1" role="dialog" aria-labelledby="image" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title fw-600" id="image">{{ $lang->data['image'] ?? 'Image' }}</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row g-3 align-items-center">
                        <div class="col-md-12">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ $lang->data['close'] ?? 'Close' }}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade " id="addpayment" tabindex="-1" role="dialog" aria-labelledby="addpayment"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title fw-600" id="addpayment">
                        {{ $lang->data['payment_details'] ?? 'Payment Details' }}</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="row g-2 align-items-center">
                            <div class=" col-12">
                                <div class="row mb-50 align-items-center">
                                    <div class="col text-sm fw-500">
                                        {{ $lang->data['customer_name'] ?? 'Customer Name' }}:</div>
                                    <div class="col-auto text-sm fw-500">{{ $customer->name ?? '' }}</div>
                                </div>
                                <div class="row mb-50 align-items-center">
                                    <div class="col text-sm fw-500">{{ $lang->data['order_id'] ?? 'Order ID' }}:
                                    </div>
                                    <div class="col-auto text-sm fw-500">{{ $order->order_number }}</div>
                                </div>
                                <div class="row mb-50 align-items-center">
                                    <div class="col text-sm fw-500">{{ $lang->data['order_date'] ?? 'Order Date' }}:
                                    </div>
                                    <div class="col-auto  text-sm fw-500">
                                        {{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y') }}</div>
                                </div>
                                <div class="row mb-50 align-items-center">
                                    <div class="col text-sm fw-500">
                                        {{ $lang->data['delivery_date'] ?? 'Delivery Date' }}:</div>
                                    <div class="col-auto  text-sm fw-500">
                                        {{ \Carbon\Carbon::parse($order->delivery_date)->format('d/m/Y') }}</div>
                                </div>
                                <hr>
                                <div class="row mb-50 align-items-center">
                                    <div class="col text-sm fw-500">
                                        {{ $lang->data['order_amount'] ?? 'Order Amount' }}:</div>
                                    <div class="col-auto  text-sm fw-500">{{ getCurrency() }}
                                        {{ number_format($order->total, 2) }}</div>
                                </div>
                                <div class="row mb-50 align-items-center">
                                    <div class="col text-sm fw-500">
                                        {{ $lang->data['paid_amount'] ?? 'Paid Amount' }}:
                                    </div>
                                    <div class="col-auto text-sm fw-500">{{ getCurrency() }}
                                        {{ number_format($order->total - $balance, 2) }}</div>
                                </div>
                                <hr>
                                <div class="row align-items-center">
                                    <div class="col text-sm fw-600">{{ $lang->data['balance'] ?? 'Balance' }}:</div>
                                    <div class="col-auto text-sm fw-600">{{ getCurrency() }}
                                        {{ number_format($balance, 2) }}</div>
                                </div>
                                <hr>
                                <div class="row align-items-center">
                                    <div class="col-md-6 mb-1">
                                        <label
                                            class="form-label">{{ $lang->data['paid_amount'] ?? 'Paid Amount' }}</label>
                                        <input type="number" class="form-control"
                                            placeholder="{{ $lang->data['enter_amount'] ?? 'Enter Amount' }}"
                                            wire:model="paid_amount">
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label
                                            class="form-label">{{ $lang->data['payment_type'] ?? 'Payment Type' }}</label>
                                        <select class="form-select" wire:model="payment_type">
                                            <option value="">
                                                {{ $lang->data['choose_payment_type'] ?? 'Choose Payment Type' }}
                                            </option>
                                            <option class="select-box" value="1">
                                                {{ $lang->data['cash'] ?? 'Cash' }}</option>
                                            <option class="select-box" value="2">
                                                {{ $lang->data['upi'] ?? 'UPI' }}</option>
                                            <option class="select-box" value="3">
                                                {{ $lang->data['card'] ?? 'Card' }}</option>
                                            <option class="select-box" value="4">
                                                {{ $lang->data['cheque'] ?? 'Cheque' }}</option>
                                            <option class="select-box" value="5">
                                                {{ $lang->data['bank_transfer'] ?? 'Bank Transfer' }}</option>
                                        </select>
                                    </div>
                                    @error('payment_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    @error('paid_amount')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ $lang->data['cancel'] ?? 'Cancel' }}</button>
                        <button type="button" class="btn btn-primary"
                            wire:click.prevent="addPayment">{{ $lang->data['save'] ?? 'Save' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
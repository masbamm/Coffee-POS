<div class="col-md-5">
    <div class="card">
        <div class="card-body"> ​
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Sub Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(row, index) in shoppingCart">
                            <td>@{{ row . name }} (@{{ row . code }})</td>
                            <td>@{{ (row . price) | currency }}</td>
                            <td>@{{ row . qty }}</td>
                            <td>@{{ row . qty * row . price }}</td>
                            <td>
                                <button @click.prevent="removeCart(index)" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3">Total</th>
                            <td>@{{ total }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="card-footer text-muted">
            @if (url()->current() == route('order.transaksi'))
                <a href="{{ route('order.checkout') }}" class="btn btn-info btn-sm float-right">
                    Checkout
                </a>
            @else
                <a href="{{ route('order.transaksi') }}" class="btn btn-secondary btn-sm float-right">
                    Kembali
                </a>
            @endif
        </div>
    </div>
</div>

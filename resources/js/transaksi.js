import Vue from 'vue'
import axios from 'axios'
import VueSweetAlert2 from 'vue-sweetalert2'

Vue.filter('currency', function (money) {
  return accounting.formatMoney(money, "Rp ", 2, ".", ",")
})

Vue.use(VueSweetAlert2)

new Vue({
  el: '#dw',
  data: {
      product: {
          id: '',
          qty: '',
          price: '',
          name: '',
          description:'',
          photo: ''
      },
      cart:{
          product_id: '',
          qty: 1,
      },
      customer: {
          bukti:'',
          paid:0,
          catatan:''
      },
      submitForm: false,
      errorMessage: '',
      message: '',
      total:0,
      shoppingCart:[],
      submitCart: false
  },
  watch: {
      //apabila nilai dari product > id berubah maka
      'cart.product_id': function() {
        if (this.cart.product_id) {
            this.getProduct()
        }
    }
  },
  //menggunakan library select2 ketika file ini di-load
  mounted() {
    $('#product_id').select2({
        width: '100%'
    }).on('change', () => {
        this.cart.product_id = $('#product_id').val();
    });
    this.getCart()
    this.getAmmount()
  },
  methods: {
      getProduct() {
          //fetch ke server menggunakan axios dengan mengirimkan parameter id
          //dengan url /api/product/{id}
          axios.get(`/api/product/${this.cart.product_id}`)
          .then((response) => {
              //assign data yang diterima dari server ke var product
              this.product = response.data
          })
      },

      addToCart(){
          this.submitCart = true;

          axios.post('/api/cart', this.cart).then((response) => {
              setTimeout(() => {
                  this.shoppingCart = response.data
                  this.cart.product_id = ''
                  this.getAmmount()
                  this.cart.qty = 1
                  this.product = {
                      id:'',
                      price:'',
                      name:'',
                      photo:''
                  }
                  $('#product_id').val('')
                  this.submitCart = false
              },2000)
          })
          .catch((error) => {
            console.log(error)
          })
      },

      getCart(){
          axios.get('/api/cart').then((response) =>{
              this.shoppingCart = response.data
          })
      },

      getAmmount(){
        axios.get('/api/ammount').then((response) =>{
            this.total = response.data
            console.log(response.data)
        })
    },

      removeCart(id) {
        this.$swal({
            title: 'Kamu Yakin?',
            text: 'Kamu Tidak Dapat Mengembalikan Tindakan Ini!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Iya, Lanjutkan!',
            cancelButtonText: 'Tidak, Batalkan!',
            showCloseButton: true,
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return new Promise((resolve) => {
                    setTimeout(() => {
                        resolve()
                    }, 2000)
                })
            },
            allowOutsideClick: () => !this.$swal.isLoading()
        }).then ((result) => {
            if (result.value) {
                axios.delete(`/api/cart/${id}`)
                .then ((response) => {
                    this.getCart();
                    this.getAmmount();
                })
                .catch ((error) => {
                    console.log(error);
                })
            }
        })
    },
    sendOrder() {
        //Mengosongkan var errorMessage dan message
        this.errorMessage = ''
        this.message = ''

        //jika var customer.email dan kawan-kawannya tidak kosong
        if (this.customer.name != '') {
           if(this.customer.paid < 0){
                //jika form kosong, maka error message ditampilkan
            this.errorMessage = 'Jumlah bayar tidak boleh negatif'
           } else if(this.customer.paid < this.total){
            //jika form kosong, maka error message ditampilkan
            this.errorMessage = 'Jumlah bayar tidak boleh kurang dari total bayar'
           } else{
                //maka akan menampilkan kotak dialog konfirmasi
            this.$swal({
                title: 'Kamu Yakin?',
                text: 'Kamu Tidak Dapat Mengembalikan Tindakan Ini!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Iya, Lanjutkan!',
                cancelButtonText: 'Tidak, Batalkan!',
                showCloseButton: true,
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return new Promise((resolve) => {
                        setTimeout(() => {
                            resolve()
                        }, 2000)
                    })
                },
                allowOutsideClick: () => !this.$swal.isLoading()
            }).then ((result) => {
                //jika di setujui
                if (result.value) {
                    //maka submitForm akan di-set menjadi true sehingga menciptakan efek loading
                    this.submitForm = true
                    //mengirimkan data dengan uri /checkout
                    axios.post('/checkout', this.customer)
                    .then((response) => {
                        setTimeout(() => {
                            //jika responsenya berhasil, maka cart di-reload
                            this.getCart();
                            this.getAmmount();
                            //message di-set untuk ditampilkan
                            this.message = response.data.message
                            //form customer dikosongkan
                            this.customer = {
                                name:'',
                                paid:0,
                                catatan:''
                            }
                            //submitForm kembali di-set menjadi false
                            this.submitForm = false

                            window.location.href = '/order/pdf/'+this.message
                        }, 1000)
                    })
                    .catch((error) => {
                        console.log(error)
                    })
                }
            })
           }
        } else {
            //jika form kosong, maka error message ditampilkan
            this.errorMessage = 'Masih ada inputan yang kosong!'
        }
    }
  }
})
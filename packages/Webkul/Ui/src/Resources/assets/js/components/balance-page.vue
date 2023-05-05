<template>
    <div>
        <div class="row align-items-stretch">

            <div class="col-md-6">
                <div class="card" :class="selectedCard == 'out' ? 'border-primary' : ''">
                    <div class="card-header d-flex justify-content-between align-items-center" :class="selectedCard == 'out' ? 'bg-primary' : ''">

                        <h3 :class="selectedCard == 'out' ? 'text-white' : ''">Outstanding Balance</h3>

                        <div>
                            <button type="button" @click="isOpen = true" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Redeem Balance
                            </button>
                            <button type="button" @click="toggleTable('out')"  class="btn btn-secondary ml-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Display Details
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ outstandingbalance }} SAR</h5>
                        <p class="card-text">This balance is available to redeem.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card" :class="selectedCard == 'pending' ? 'border-primary' : ''">
                    <div class="card-header d-flex justify-content-between align-items-center" :class="selectedCard == 'pending' ? 'bg-primary text-white' : ''">
                        <h3 :class="selectedCard == 'pending' ? 'text-white' : ''">Pending Balance</h3>

                        <div>
                            <button type="button" @click="toggleTable('pending')" class="btn btn-secondary ml-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Display Details
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ pendingbalance }} SAR</h5>
                        <p class="card-text">This balance is subject to change according to the refund policy.</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="account-items-list" v-if="selectedCard == 'out'">
            <div class="account-table-content">
                <datagrid-plus :src="outstandingRoute" :key="'out'"></datagrid-plus>
            </div>
        </div>
        <div class="account-items-list" v-else>
            <div class="account-table-content">
                <datagrid-plus :src="pendingRoute" :key="'pending'"></datagrid-plus>
            </div>
        </div>

        <div class="modal-container" v-if="isOpen">
            <div class="modal-header">
                <slot name="header">
                    Redeem Balance
                </slot>
                <i class="icon remove-icon" @click="closeModal"></i>
            </div>

            <div class="modal-body">
                <slot name="body">
                    <form>
                        <div class="form-group">
                            <label for="amount">Amount:</label>
                            <input v-model="amount" type="text" class="form-control" id="amount">
                            <span v-if="isDisabled" class="text-danger">Please enter a valid amount.</span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" @click.prevent="redeemBalance" :disabled="isDisabled">
                                <span v-if="isLoading">
                                    Redeeming your balance...
                                    <i class="fa fa-spinner fa-spin"></i>
                                </span>
                                <span v-else>
                                    Redeem Now
                                </span>
                            </button>
                            <div v-if="isLoading === false && redeemed" class="alert alert-success mt-3" role="alert">
                                Your balance has been redeemed successfully!
                            </div>
                        </div>
                    </form>
                </slot>
            </div>
        </div>
    </div>

</template>

<script>
export default {

    props: [
        'outstandingbalance',
        'pendingbalance',
        'route'
    ],

    data: function() {
        return {
            selectedCard: 'out',
            pendingRoute: this.route + '?outstanding=0',
            outstandingRoute: this.route + '?outstanding=1',
            isOpen: false,
            amount: 0,
            isLoading: false,
            redeemed: false
        };
    },

    mounted: function() {

    },

    methods: {
        toggleTable: function(value) {
            this.selectedCard = value
        },

        redeemBalance() {
            this.isLoading = true;

            // Your code to redeem the balance goes here

            setTimeout(() => {
                this.isLoading = false;
                this.redeemed = true
            }, 3000);
        },

        closeModal () {
            this.redeemed = false
            this.isOpen = false
        }
    },

    computed: {
        iconClass: function() {
            return {
                [this.downIconClass]: !this.isActive,
                [this.upIconClass]: this.isActive
            };
        },

        isDisabled() {
            return this.amount > this.outstandingbalance;
        }
    }
};
</script>

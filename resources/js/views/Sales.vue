<template>
  <v-main>
    <h2>Recent Sales</h2>
    <v-spacer></v-spacer>
    <v-data-table
      :headers="headers"
      :items="payments"
      :items-per-page="5"
      class="elevation-1 pt-5"
    ></v-data-table>
  </v-main>
</template>
<script>
export default {
  data() {
    return {
      headers: [
        { text: "Payment Intent ID", value: "payment_intent_id" },
        { text: "Status", value: "status" },
        { text: "Amount ($)", value: "amount" },
        { text: "Currency", value: "currency" },
        { text: "Created At", value: "created_at" },
      ],
      payments: [], 
    };
  },
  created() {
    console.log('Fetching payments');
    this.fetchPayments();
  },
  methods: {
    async fetchPayments() {
      const response = await fetch('/api/app/payments'); // Adjust if you have a specific base URL
      const data = await response.json();
      this.payments = data.map(payment => ({
        ...payment,
        amount: payment.amount / 100, // Assuming amount is in cents
        created_at: new Date(payment.created_at).toLocaleDateString(), // Format date
      }));
    },
  },
};
</script>
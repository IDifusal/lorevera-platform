<template>
    <div
        class="d-flex align-center justify-center center-div"
        style="height: 100vh"
    >
        <v-sheet width="400" class="mx-auto">
            <v-form @submit.prevent="submitForm" class="pa-5 pa-md-0">
                <div class="w-100 d-flex justify-center">
                    <img
                        src="https://lorevera.com/wp-content/uploads/2020/03/LoreVera-Logo-white.png"
                        alt="Fitvera"
                        class="text-center w-50"
                    />
                </div>
                <h2 class="text-center">
                    {{ formType === "login" ? "Sign In" : "Create Account" }}
                </h2>
                <v-text-field
                    variant="outlined"
                    v-model="email"
                    label="Email"
                ></v-text-field>

                <v-text-field
                    variant="outlined"
                    v-model="password"
                    label="Password"
                    :type="showPassword ? 'text' : 'password'"
                ></v-text-field>
                <v-alert
                    v-if="success"
                    :text="formResponse"
                    type="success"
                    variant="tonal"
                ></v-alert>
                <v-alert
                    v-if="formError"
                    :text="formError"
                    type="error"
                    variant="tonal"
                ></v-alert>
                <v-btn type="submit" color="lorevera" block class="mt-2">{{
                    formType === "login" ? "Sign In" : "Sign Up"
                }}</v-btn>
            </v-form>
        </v-sheet>
    </div>
</template>

<script setup>
import { computed, onMounted } from "vue";
import { useUserStore } from "../store/user.store";
const userStore = useUserStore();
const router = useRouter();
const isUserLoggedIn = computed(() => userStore.isUserLoggedgetUserDataIn);
onMounted(() => {
    console.log("isUserLoggedIn", userStore.user);
    if (userStore.user) {
        router.push({ name: "dashboard" });
    }
});
</script>
<script>
import axios from "axios"; // Import axios
import { useRouter } from "vue-router";

export default {
    data() {
        return {
            email: "",
            password: "",
            formType: "login",
            showPassword: false,
            formError: null, // Error message for the entire form
            success: false, // Success status
            emailVerificationRequired: false,
            errorMessage: null,
            formResponse: null,
        };
    },
    methods: {
        async submitForm() {
            try {
                this.formError = null;

                let apiEndpoint = "";

                if (this.formType === "login") {
                    console.log("LOGIN");
                    apiEndpoint = "/api/web/login";
                } else {
                    console.log("register");
                    apiEndpoint = "/api/register";
                }

                const response = await axios.post(apiEndpoint, {
                    email: this.email,
                    password: this.password,
                });
                this.formError = response.data.message;
                if (this.formType === "login") {
                    useUserStore().setIslogged(true);
                    localStorage.setItem("authToken", response.data.token);
                    this.success = true;
                    this.$router.push({ name: "dashboard" });
                }
            } catch (error) {
                if (error.response) {
                    if (error.response.status === 422) {
                        const responseError = error.response.data;
                        if (responseError.message) {
                            this.formError = responseError.message;
                        }
                    } else if (
                        error.response.status === 403 &&
                        error.response.data.email_verification_required
                    ) {
                        this.emailVerificationRequired = true;
                        this.formError =
                            "Email verification is required. Please check your email for a verification link.";
                    } else {
                        this.formError = error.response.data.message
                            ? error.response.data.message
                            : "An error occurred. Please try again.";
                    }
                } else {
                    this.formError = "An error occurred. Please try again.";
                }
                console.error(error);
            }
        },
        openRecoveryDialog() {
            this.$refs.passwordRecoveryDialog.openDialog();
        },
        toggleForm() {
            this.formError = null;
            this.formType = this.formType === "login" ? "signup" : "login";
        },
        async resendVerificationCode() {
            try {
                const response = await axios.post(
                    "/api/resend-verification-code",
                    {
                        email: this.email,
                    }
                );

                if (response.data.message === "Verification code resent") {
                    // You can show a success message or perform any other necessary actions
                    console.log("Verification code resent");
                }
            } catch (error) {
                // Handle errors, e.g., show an error message
                console.error("Failed to resend verification code", error);
            }
        },
    },
};
</script>
<style scoped>
.v-toolbar__content {
    display: none !important;
}
.v-navigation-drawer {
    display: none !important;
}
.center-div {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
</style>

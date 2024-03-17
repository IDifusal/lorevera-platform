import{u as g,c as y,o as w,a as i,b as V,d as r,w as n,V as v,e as d,f as E,g as b,h as S,i as l,t as c,j as m,k as p,l as u,m as f,n as _,p as k,q as I,r as T}from"./app-BzRu1lno.js";import{_ as F}from"./_plugin-vue_export-helper-DlAUqK2U.js";const L=e=>(I("data-v-23eed6d5"),e=e(),T(),e),R={class:"d-flex align-center justify-center center-div",style:{height:"100vh"}},U=L(()=>l("div",{class:"w-100 d-flex justify-center"},[l("img",{src:"https://lorevera.com/wp-content/uploads/2020/03/LoreVera-Logo-white.png",alt:"Fitvera",class:"text-center w-50"})],-1)),P={class:"text-center"},q={data(){return{email:"",password:"",formType:"login",showPassword:!1,formError:null,success:!1,emailVerificationRequired:!1,errorMessage:null,formResponse:null}},methods:{async submitForm(){try{this.formError=null;let e="";this.formType==="login"?(console.log("LOGIN"),e="/api/web/login"):(console.log("register"),e="/api/register");const o=await d.post(e,{email:this.email,password:this.password});this.formError=o.data.message,this.formType==="login"&&(g().setIslogged(!0),localStorage.setItem("authToken",o.data.token),this.success=!0,this.$router.push({name:"dashboard"}))}catch(e){if(e.response)if(e.response.status===422){const o=e.response.data;o.message&&(this.formError=o.message)}else e.response.status===403&&e.response.data.email_verification_required?(this.emailVerificationRequired=!0,this.formError="Email verification is required. Please check your email for a verification link."):this.formError=e.response.data.message?e.response.data.message:"An error occurred. Please try again.";else this.formError="An error occurred. Please try again.";console.error(e)}},openRecoveryDialog(){this.$refs.passwordRecoveryDialog.openDialog()},toggleForm(){this.formError=null,this.formType=this.formType==="login"?"signup":"login"},async resendVerificationCode(){try{(await d.post("/api/resend-verification-code",{email:this.email})).data.message==="Verification code resent"&&console.log("Verification code resent")}catch(e){console.error("Failed to resend verification code",e)}}}},x=Object.assign(q,{__name:"Login",setup(e){const o=g(),h=E();return y(()=>o.isUserLoggedgetUserDataIn),w(()=>{console.log("isUserLoggedIn",o.user),o.user&&h.push({name:"dashboard"})}),(s,a)=>(i(),V("div",R,[r(v,{width:"400",class:"mx-auto"},{default:n(()=>[r(b,{onSubmit:S(s.submitForm,["prevent"]),class:"pa-5 pa-md-0"},{default:n(()=>[U,l("h2",P,c(s.formType==="login"?"Sign In":"Create Account"),1),r(m,{variant:"outlined",modelValue:s.email,"onUpdate:modelValue":a[0]||(a[0]=t=>s.email=t),label:"Email"},null,8,["modelValue"]),r(m,{variant:"outlined",modelValue:s.password,"onUpdate:modelValue":a[1]||(a[1]=t=>s.password=t),label:"Password",type:s.showPassword?"text":"password"},null,8,["modelValue","type"]),s.success?(i(),p(u,{key:0,text:s.formResponse,type:"success",variant:"tonal"},null,8,["text"])):f("",!0),s.formError?(i(),p(u,{key:1,text:s.formError,type:"error",variant:"tonal"},null,8,["text"])):f("",!0),r(_,{type:"submit",color:"lorevera",block:"",class:"mt-2"},{default:n(()=>[k(c(s.formType==="login"?"Sign In":"Sign Up"),1)]),_:1})]),_:1},8,["onSubmit"])]),_:1})]))}}),N=F(x,[["__scopeId","data-v-23eed6d5"]]);export{N as default};
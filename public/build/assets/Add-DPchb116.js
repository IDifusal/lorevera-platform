import{s as i,a as w,b,i as n,d as a,w as s,h as y,g as I,F as U,j as p,v as f,x as d,I as c,n as x,p as q,f as F}from"./app-CGGBKZkl.js";import{u as N,S,E as B}from"./index-CxtJX7Sq.js";import{U as E}from"./UploadVideo-blAC17M8.js";import{U as R}from"./UploadImage-DR4P8ZtQ.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const T=n("div",null,"Creating New WarmUp",-1),k={class:"form-group"},D=n("label",{for:"quantity"},"Name:",-1),M=n("label",{for:"quantity"},"Reps:",-1),j=n("label",{for:"quantity"},"Sets:",-1),A=n("label",{for:"Content"},"Content:",-1),H=n("label",{for:"quantity"},"Image:",-1),K=n("label",{for:"video"},"Video:",-1),O={__name:"Add",setup(L){const v=F(),t=i({}),r=i(null),u=i(null),g=e=>{console.log(e),u.value=e[0]},_=()=>{u.value=null},V=e=>{r.value=e[0]},h=()=>{r.value=null},m=N({content:"<p>Content <strong> add here</strong></p>",extensions:[S]}),C=async()=>{if(!t.value.name||!t.value.reps||!t.value.sets)return;const e=new FormData;e.append("name",t.value.name),e.append("reps",t.value.reps),e.append("sets",t.value.sets),e.append("content",m.value.getHTML()),e.append("type","warmup"),r.value&&e.append("image",r.value),u.value&&e.append("video",u.value);try{const l=await axios.post("/api/web/store-warmup",e,{headers:{"Content-Type":"multipart/form-data"}});console.log(l),v.push({name:"warm-up-list"})}catch(l){console.log(l)}};return(e,l)=>(w(),b(U,null,[T,n("div",k,[a(I,{ref:"form","fast-fail":"",onSubmit:l[3]||(l[3]=y(o=>C(),["prevent"]))},{default:s(()=>[D,a(p,{modelValue:t.value.name,"onUpdate:modelValue":l[0]||(l[0]=o=>t.value.name=o),"hide-details":"","single-line":"",rules:[o=>!!o||"Item is required"]},null,8,["modelValue","rules"]),a(f,{align:"start",style:{height:"150px"},"no-gutters":"",ga:""},{default:s(()=>[a(d,{class:"mr-5"},{default:s(()=>[M,a(p,{modelValue:t.value.reps,"onUpdate:modelValue":l[1]||(l[1]=o=>t.value.reps=o),"hide-details":"","single-line":"",rules:[o=>!!o||"Reps is required"],type:"number"},null,8,["modelValue","rules"])]),_:1}),a(d,null,{default:s(()=>[j,a(p,{modelValue:t.value.sets,"onUpdate:modelValue":l[2]||(l[2]=o=>t.value.sets=o),"hide-details":"","single-line":"",rules:[o=>!!o||"Item is required"],type:"number"},null,8,["modelValue","rules"])]),_:1})]),_:1}),A,a(c(B),{editor:c(m)},null,8,["editor"]),a(f,null,{default:s(()=>[a(d,null,{default:s(()=>[H,a(R,{onCleanImg:h,onChanged:V})]),_:1}),a(d,null,{default:s(()=>[K,a(E,{onCleanImg:_,onChanged:g})]),_:1})]),_:1}),a(x,{class:"mt-10",color:"lorevera",type:"submit"},{default:s(()=>[q("Save Changes")]),_:1})]),_:1},512)])],64))}};export{O as default};
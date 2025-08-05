"use strict";(globalThis.webpackChunkwp_event_solution=globalThis.webpackChunkwp_event_solution||[]).push([[87],{11883:(e,t,n)=>{n.d(t,{A:()=>l});var a=n(51609),i=n(6836);const l=({height:e=22,width:t=22})=>(0,i.iconCreator)((()=>(({height:e,width:t})=>(0,a.createElement)("svg",{xmlns:"http://www.w3.org/2000/svg",width:"20",height:"20",fill:"none",viewBox:"0 0 20 20"},(0,a.createElement)("path",{stroke:"currentColor",strokeLinecap:"round",strokeLinejoin:"round",strokeWidth:"1.5",d:"M6.25 4.121h7.083c.69 0 1.25.56 1.25 1.25v1.25M12.5 10.788h-5M10 14.121H7.5"}),(0,a.createElement)("path",{stroke:"currentColor",strokeLinecap:"round",strokeWidth:"1.5",d:"M15.414 1.667H5.256c-.414 0-.837.06-1.172.306-1.062.78-1.88 2.517-.228 4.086.464.44 1.112.6 1.75.6h9.63c.662 0 1.847.095 1.847 2.114v6.211a3.34 3.34 0 0 1-3.33 3.35H6.226c-1.836 0-3.172-1.298-3.277-3.274L2.922 4.304"})))({height:e,width:t})))},19575:(e,t,n)=>{n.d(t,{A:()=>o});var a=n(52619),i=n(27723),l=n(64282);const o=async(e,t)=>{try{const n=await l.A.extensions.updateExtension({name:e,status:t});return(0,a.doAction)("eventin_notification",{type:"success",message:n?.message}),!0}catch(e){return(0,a.doAction)("eventin_notification",{type:"error",message:e?.message||(0,i.__)("Update failed! Please check the plugin list and try again.","eventin")}),!1}}},53087:(e,t,n)=>{n.r(t),n.d(t,{default:()=>ee});var a=n(51609),i=n(29491),l=n(47143),o=n(27723),r=n(86087),s=n(67313),c=n(75093),d=n(47152),m=n(16370),p=n(75063),g=n(77278);const v=()=>(0,a.createElement)(d.A,{gutter:[16,16]},(0,a.createElement)(m.A,{xs:24,sm:24},(0,a.createElement)(p.A.Input,{active:!0,size:"large",style:{margin:"20px 0"}})),[...Array(6)].map(((e,t)=>(0,a.createElement)(m.A,{xs:24,sm:12,md:8,key:t},(0,a.createElement)(g.A,{style:{borderRadius:8}},(0,a.createElement)(p.A.Avatar,{active:!0,size:"large",shape:"circle",style:{marginBottom:16,marginRight:16}}),(0,a.createElement)(p.A.Input,{style:{width:200,marginBottom:8},active:!0}),(0,a.createElement)(p.A.Input,{style:{width:120,marginBottom:8},active:!0}),(0,a.createElement)("div",{style:{display:"flex",gap:10,alignItems:"center",marginTop:16}},(0,a.createElement)(p.A.Button,{style:{width:100},active:!0}),(0,a.createElement)(p.A.Button,{style:{width:100},active:!0})))))));var x=n(56427),u=n(92911),E=n(79664),h=n(18062),_=n(27154);function f(e){const{title:t}=e;return(0,a.createElement)(x.Fill,{name:_.PRIMARY_HEADER_NAME},(0,a.createElement)(u.A,{justify:"space-between",align:"center",wrap:"wrap",gap:20},(0,a.createElement)(h.A,{title:t}),(0,a.createElement)("div",{style:{display:"flex",alignItems:"center",gap:"12px"}},(0,a.createElement)(E.A,null))))}var w=n(80560),A=n(11883),b=n(6836);const k=({height:e=22,width:t=22})=>(0,b.iconCreator)((()=>(({height:e,width:t})=>(0,a.createElement)("svg",{xmlns:"http://www.w3.org/2000/svg",width:"14",height:"14",fill:"none",viewBox:"0 0 14 14"},(0,a.createElement)("path",{fill:"#fff",fillRule:"evenodd",d:"M6.999 1.895a2.04 2.04 0 0 0-2.042 2.042v.91a57 57 0 0 1 2.042-.035c.72 0 1.39.012 2.041.035v-.91A2.04 2.04 0 0 0 7 1.895M3.79 3.937v1.036a2.51 2.51 0 0 0-1.735 2.059c-.087.641-.16 1.316-.16 2.009s.073 1.368.16 2.01c.158 1.176 1.133 2.106 2.333 2.16.834.04 1.68.06 2.61.06.932 0 1.778-.02 2.611-.06 1.2-.054 2.175-.984 2.334-2.16.086-.642.16-1.317.16-2.01s-.074-1.368-.16-2.01a2.5 2.5 0 0 0-1.736-2.057V3.936a3.208 3.208 0 1 0-6.417 0m6.125 5.098a.583.583 0 1 0-1.166 0v.006a.583.583 0 1 0 1.166 0zM7 8.452c.322 0 .583.261.583.583v.006a.583.583 0 1 1-1.167 0v-.006c0-.322.262-.583.584-.583m-1.75.583a.583.583 0 1 0-1.167 0v.006a.583.583 0 1 0 1.167 0z",clipRule:"evenodd"})))({height:e,width:t})));var y=n(7638),C=n(43960),z=n(69815);const T=z.default.div`
	background-color: #f4f6fa;
	padding: 12px 32px;
	min-height: 100vh;

	.addons-area-heading {
		width: 50%;
		margin-bottom: 30px;
		@media ( max-width: 768px ) {
			width: 100%;
		}
	}
`,R=z.default.div`
	background: #fff;
	border-radius: 8px;
	margin-bottom: 30px;
	padding: 30px;
	@media ( max-width: 768px ) {
		padding: 20px;
	}
	.etn-extension-title {
		font-size: 24px;
		margin: 25px 0;
		padding: 14px 0;
		display: inline-block;
		border-bottom: 2px solid #d9d9d9;
	}
	.ant-tabs-tab {
		font-size: 18px;
		font-weight: 600;
		padding: 16px 30px;
	}
	.ant-tabs-top > .ant-tabs-nav::before {
		border-bottom: 2px solid #d9d9d9;
	}
`,L=(0,z.default)(g.A)`
	border-radius: 8px;
	margin: 0;
	min-height: 340px;
	overflow: hidden;
	position: relative;
	.etn-module-card-header {
		display: flex;
		justify-content: space-between;
		gap: 20px;
		@media ( max-width: 768px ) {
			flex-wrap: wrap;
		}
	}
	.etn-card-desc {
		font-size: 14px;
		color: #838790;
		.etn-doc-link {
			color: ${_.PRIMARY_COLOR};
			margin-top: 20px;
			a {
				display: flex;
				gap: 8px;
				font-size: 16px !important;
				font-weight: 600 !important;
				text-decoration: none !important;
			}
		}
	}
	.etn-link-button {
		color: ${_.PRIMARY_COLOR};
		font-size: 15px;
		font-weight: 600;
		margin-top: 10px;
		text-decoration: underline;
		&:hover {
			text-decoration: underline;
			color: ${_.PRIMARY_COLOR};
		}
	}
	@media ( max-width: 768px ) {
		.ant-card .ant-card-body {
			padding: 40px 10px;
		}
	}
	.ant-switch .ant-switch-loading-icon.anticon {
		position: relative;
		top: -2px;
		color: rgba( 0, 0, 0, 0.65 );
		vertical-align: top;
	}
`,B=(z.default.span`
	font-size: 24px;
	margin-right: 10px;
`,z.default.div`
	position: absolute;
	height: 85px;
	width: 60px;
	transform: rotate( -45deg );
	top: -38px;
	right: -22px;
	background-color: #faad14;
	color: #fff;
	padding: 5px 16px;
	.anticon {
		position: absolute;
		top: 38px;
		left: 7px;
		transform: rotate( 45deg );
	}
`);var N=n(19575);const{Title:S,Text:M,Link:I}=s.A,D=({name:e,title:t,description:n,status:i,icon:l,demo_link:s,is_pro:d,doc_link:m,upgrade_link:p,upgrade:g,notice:v,invalidateExtensions:x})=>{const[E,h]=(0,r.useState)("off"!==i),[_,f]=(0,r.useState)(!1),[w,b]=(0,r.useState)(!1),z=async t=>{f(!0),await(0,N.A)(e,t?"on":"off",h)?(h(t),x()):h(!t),f(!1)},T=async t=>{b(!0),await(0,N.A)(e,t),x(),b(!1)},R=!!window.localized_data_obj.evnetin_pro_active,I={fontSize:"16px",padding:"6px 14px",marginTop:"20px"};return(0,a.createElement)(L,null,!R&&"eventin-divi-addon"!==e&&(0,a.createElement)(B,null,(0,a.createElement)(k,null)),(0,a.createElement)("div",null,(0,a.createElement)("div",{className:"etn-module-card-header"},(0,a.createElement)("div",{dangerouslySetInnerHTML:{__html:l}}),R&&d&&(0,a.createElement)(C.A,{className:"etn-addon-module-switch",loading:_,checked:E,onChange:z}),"eventin-divi-addon"==e&&(0,a.createElement)(C.A,{className:"etn-addon-module-switch",loading:_,checked:E,onChange:z})),(0,a.createElement)("div",null,(0,a.createElement)(S,{level:4,style:{margin:"10px 0",fontSize:"20px"}},t),(0,a.createElement)("div",{className:"etn-card-desc",style:{marginRight:"30px"}},(0,a.createElement)("div",{style:{marginBottom:"20px"}},(0,a.createElement)(M,null,n)," ",(0,a.createElement)("br",null),v&&(0,a.createElement)(M,{style:{display:"flex",color:"#ff7129",marginTop:"10px"}},v),(0,a.createElement)("div",{className:"etn-doc-link"},(0,a.createElement)(c.LinkText,{href:m,target:"_blank"},(0,a.createElement)(A.A,null)," ",(0,o.__)("Documentation","eventin")))),"on"==i&&(0,a.createElement)(y.Ay,{variant:y.zB,onClick:()=>{T("install")},target:"_blank",sx:I,loading:w},(0,o.__)("Install","eventin")),"install"==i&&(0,a.createElement)(y.Ay,{variant:y.zB,onClick:()=>{T("activate")},target:"_blank",sx:I,loading:w},(0,o.__)("Activate","eventin")),"upgrade"==i&&g&&(0,a.createElement)(y.Ay,{variant:y.zB,href:p,target:"_blank",sx:I,loading:w},(0,o.__)("Download","eventin")),"activate"==i&&(0,a.createElement)(u.A,{gap:20,wrap:"wrap"},(0,a.createElement)(y.Ay,{variant:y.Vt,onClick:()=>{T("deactivate")},target:"_blank",sx:I,loading:w},(0,o.__)("Deactivate","eventin"))),!R&&"eventin-divi-addon"!==e&&(0,a.createElement)("div",{style:{marginTop:"20px"}},s&&(0,a.createElement)(c.ProButton,null))))))},{Title:j,Text:O,Link:F}=s.A,H=(0,l.withDispatch)((e=>{const t=e("eventin/global");return{invalidateExtensions:()=>t.invalidateResolution("getExtensions")}})),P=(0,l.withSelect)((e=>{const t=e("eventin/global");return{extensions:t.getExtensions(),isExtensionsLoading:t.isResolving("getExtensions")}})),V=(0,i.compose)(P,H)((e=>{const{extensions:t,isExtensionsLoading:n,invalidateExtensions:i}=e||{},[l,o]=(0,r.useState)([]);return(0,r.useEffect)((()=>{if(t){const e=Object.values(t).filter((e=>"addon"===e.type));o(e)}}),[t]),(0,a.createElement)("div",{className:"etn-module-section"},(0,a.createElement)(d.A,{gutter:[30,30]},l.map((e=>(0,a.createElement)(m.A,{key:e.name,xs:24,sm:12,xl:8},(0,a.createElement)(D,{...e,invalidateExtensions:i}))))))})),{Title:Y,Text:$,Link:W}=s.A,K=({name:e,title:t,description:n,status:i,notice:l,icon:s,settings_link:d,demo_link:m,doc_link:p,is_pro:g,upgrade_link:v,upgrade:x,deps:E,invalidateExtensions:h})=>{const[_,f]=(0,r.useState)("off"!==i),[w,b]=(0,r.useState)(!1),[z,T]=(0,r.useState)(!1),R=async t=>{b(!0),f(t),await(0,N.A)(e,t?"on":"off")?(f(t),h()):f(!t),b(!1)},S=async t=>{T(!0),await(0,N.A)(e,t),h(),T(!1)},M=!!window.localized_data_obj.evnetin_pro_active,I=(window.localized_data_obj.timetics_pro_active,{fontSize:"16px",padding:"6px 14px",marginTop:"20px"});return(0,a.createElement)(L,null,!M&&g&&(0,a.createElement)(B,null,(0,a.createElement)(k,null)),(0,a.createElement)("div",null,(0,a.createElement)("div",{className:"etn-module-card-header"},(0,a.createElement)("div",{dangerouslySetInnerHTML:{__html:s}}),(0,a.createElement)("div",{style:{display:"flex",alignItems:"center",justifyContent:"space-between",marginBottom:"18px"}},g&&M&&(0,a.createElement)(C.A,{className:"etn-addon-module-switch",loading:w,checked:_,onChange:R,disabled:!M&&g}),"seat_map"===e&&(0,a.createElement)(C.A,{className:"etn-addon-module-switch",loading:w,checked:_,onChange:R,disabled:!M&&g}),"automation"===e&&(0,a.createElement)(C.A,{className:"etn-addon-module-switch",loading:w,checked:_,onChange:R,disabled:!M&&g}))),(0,a.createElement)("div",null,(0,a.createElement)(Y,{level:4,style:{margin:"10px 0",fontSize:"20px"}},t),(0,a.createElement)("div",{className:"etn-card-desc"},(0,a.createElement)("div",{style:{marginBottom:"20px"}},(0,a.createElement)($,null,n)," ",(0,a.createElement)("br",null),l&&(0,a.createElement)($,{style:{display:"flex",color:"#ff7129",marginTop:"10px"}},l),(0,a.createElement)("div",{className:"etn-doc-link"},(0,a.createElement)(c.LinkText,{href:p,target:"_blank"},(0,a.createElement)(A.A,null)," ",(0,o.__)("Documentation","eventin")))),E&&E.length>0&&M&&g&&(0,a.createElement)(a.Fragment,null,"on"==i&&(0,a.createElement)(y.Ay,{variant:y.zB,onClick:()=>{S("install")},target:"_blank",sx:I,loading:z},(0,o.__)("Install","eventin")),"install"==i&&(0,a.createElement)(y.Ay,{variant:y.zB,onClick:()=>{S("activate")},target:"_blank",sx:I,loading:z},(0,o.__)("Activate","eventin")),"upgrade"==i&&x&&(0,a.createElement)(y.Ay,{variant:y.zB,href:v,target:"_blank",sx:I,loading:z},(0,o.__)("Download","eventin")),"activate"==i&&(0,a.createElement)(u.A,{gap:20,wrap:"wrap"},(0,a.createElement)(y.Ay,{variant:y.Vt,onClick:()=>{S("deactivate")},target:"_blank",sx:I,loading:z},(0,o.__)("Deactivate","eventin")),d&&(0,a.createElement)(y.Ay,{variant:y.Vt,target:"_blank",sx:I,href:d},(0,o.__)("Configure","eventin")))),!M&&g&&(0,a.createElement)(y.Oc,null),E&&E.length>0&&"seat_map"===e&&(0,a.createElement)(a.Fragment,null,"on"==i&&(0,a.createElement)(y.Ay,{variant:y.zB,onClick:()=>{S("install")},target:"_blank",sx:I,loading:z},(0,o.__)("Install","eventin")),"install"==i&&(0,a.createElement)(y.Ay,{variant:y.zB,onClick:()=>{S("activate")},target:"_blank",sx:I,loading:z},(0,o.__)("Activate","eventin")),"upgrade"==i&&x&&(0,a.createElement)(y.Ay,{variant:y.zB,href:v,target:"_blank",sx:I,loading:z},(0,o.__)("Download","eventin")),"activate"==i&&(0,a.createElement)(u.A,{gap:20,wrap:"wrap"},(0,a.createElement)(y.Ay,{variant:y.Vt,onClick:()=>{S("deactivate")},target:"_blank",sx:I,loading:z},(0,o.__)("Deactivate","eventin")),d&&(0,a.createElement)(y.Ay,{variant:y.Vt,target:"_blank",sx:I,href:d},(0,o.__)("Configure","eventin"))))))))},U=(0,l.withDispatch)((e=>{const t=e("eventin/global");return{invalidateExtensions:()=>t.invalidateResolution("getExtensions")}})),q=(0,l.withSelect)((e=>{const t=e("eventin/global");return{extensions:t.getExtensions(),isExtensionsLoading:t.isResolving("getExtensions")}})),G=(0,i.compose)(q,U)((e=>{const{extensions:t,isExtensionsLoading:n,invalidateExtensions:i}=e||{},[l,o]=(0,r.useState)([]);return(0,r.useEffect)((()=>{if(t){const e=Object.values(t).filter((e=>"module"===e.type));o(e)}}),[t]),(0,a.createElement)("div",{className:"etn-module-section"},(0,a.createElement)(d.A,{gutter:[30,30]},l.map((e=>(0,a.createElement)(m.A,{key:e.name,xs:24,sm:12,xl:8},(0,a.createElement)(K,{...e,invalidateExtensions:i}))))))})),{Title:J}=s.A,Q=function(e){const{activeTab:t,setActiveTab:n,extensions:i}=e||{},[l,s]=(0,r.useState)(!0);if((0,r.useEffect)((()=>{null!=i&&s(!1)}),[i]),l)return(0,a.createElement)(v,null);const c=[{key:"1",label:(0,o.__)("All","eventin"),children:(0,a.createElement)(a.Fragment,null,(0,a.createElement)(J,{level:3,className:"etn-extension-title"},(0,o.__)("Modules","eventin")),(0,a.createElement)(G,null),(0,a.createElement)(J,{level:3,className:"etn-extension-title"},(0,o.__)("Addons","eventin")),(0,a.createElement)(V,null))},{key:"2",label:(0,o.__)("Modules","eventin"),children:(0,a.createElement)(a.Fragment,null,(0,a.createElement)(J,{level:3,className:"etn-extension-title"},(0,o.__)("Modules","eventin")),(0,a.createElement)(G,null))},{key:"3",label:(0,o.__)("Addons","eventin"),children:(0,a.createElement)(a.Fragment,null,(0,a.createElement)(J,{level:3,className:"etn-extension-title"},(0,o.__)("Addons","eventin")),(0,a.createElement)(V,null))}];return(0,a.createElement)("div",{className:"etn-extensions-container"},(0,a.createElement)(R,null,(0,a.createElement)(w.A,{defaultActiveKey:t,onTabClick:e=>n(e),items:c})))},{Title:X}=s.A,Z=(0,l.withSelect)((e=>{const t=e("eventin/global");return{extensions:t.getExtensions(),isExtensionsLoading:t.isResolving("getExtensions")}})),ee=(0,i.compose)(Z)((function(e){const{extensions:t,isExtensionsLoading:n}=e,[i,l]=(0,r.useState)("1");return(0,a.createElement)(T,{className:"eventin-page-wrapper"},(0,a.createElement)(f,{title:(0,o.__)("Extensions","eventin")}),(0,a.createElement)(Q,{activeTab:i,setActiveTab:l,extensions:t,isExtensionsLoading:n}))}))}}]);
"use strict";(globalThis.webpackChunkwp_event_solution=globalThis.webpackChunkwp_event_solution||[]).push([[190],{11883:(e,t,n)=>{n.d(t,{A:()=>l});var a=n(51609),i=n(6836);const l=({height:e=22,width:t=22})=>(0,i.iconCreator)((()=>(({height:e,width:t})=>(0,a.createElement)("svg",{xmlns:"http://www.w3.org/2000/svg",width:"20",height:"20",fill:"none",viewBox:"0 0 20 20"},(0,a.createElement)("path",{stroke:"currentColor",strokeLinecap:"round",strokeLinejoin:"round",strokeWidth:"1.5",d:"M6.25 4.121h7.083c.69 0 1.25.56 1.25 1.25v1.25M12.5 10.788h-5M10 14.121H7.5"}),(0,a.createElement)("path",{stroke:"currentColor",strokeLinecap:"round",strokeWidth:"1.5",d:"M15.414 1.667H5.256c-.414 0-.837.06-1.172.306-1.062.78-1.88 2.517-.228 4.086.464.44 1.112.6 1.75.6h9.63c.662 0 1.847.095 1.847 2.114v6.211a3.34 3.34 0 0 1-3.33 3.35H6.226c-1.836 0-3.172-1.298-3.277-3.274L2.922 4.304"})))({height:e,width:t})))},19575:(e,t,n)=>{n.d(t,{A:()=>r});var a=n(52619),i=n(27723),l=n(64282);const r=async(e,t)=>{try{const n=await l.A.extensions.updateExtension({name:e,status:t});return(0,a.doAction)("eventin_notification",{type:"success",message:n?.message}),!0}catch(e){return(0,a.doAction)("eventin_notification",{type:"error",message:e?.message||(0,i.__)("Update failed! Please check the plugin list and try again.","eventin")}),!1}}},83190:(e,t,n)=>{n.r(t),n.d(t,{default:()=>D});var a=n(51609),i=n(29491),l=n(47143),r=n(27723),o=n(56427),s=n(92911),c=n(79664),d=n(18062),p=n(27154);function m(e){const{title:t}=e;return(0,a.createElement)(o.Fill,{name:p.PRIMARY_HEADER_NAME},(0,a.createElement)(s.A,{justify:"space-between",align:"center",wrap:"wrap",gap:20},(0,a.createElement)(d.A,{title:t}),(0,a.createElement)("div",{style:{display:"flex",alignItems:"center",gap:"12px"}},(0,a.createElement)(c.A,null))))}var g=n(67313),u=n(86087),x=n(47152),v=n(16370),h=n(11883),f=n(75093),E=n(7638),w=n(69815),_=n(77278);const b=w.default.div`
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
`,A=w.default.div`
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
		margin-top: 0;
	}
	.ant-tabs-tab {
		font-size: 18px;
		font-weight: 600;
		padding: 16px 30px;
	}
	.ant-tabs-top > .ant-tabs-nav::before {
		border-bottom: 2px solid #d9d9d9;
	}
`,k=(0,w.default)(_.A)`
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
			color: ${p.PRIMARY_COLOR};
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
		color: ${p.PRIMARY_COLOR};
		font-size: 15px;
		font-weight: 600;
		margin-top: 10px;
		text-decoration: underline;
		&:hover {
			text-decoration: underline;
			color: ${p.PRIMARY_COLOR};
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
`;w.default.span`
	font-size: 24px;
	margin-right: 10px;
`,w.default.div`
    position: absolute;
    height: 85px;
    width: 60px;
    transform: rotate(-45deg);
    top: -38px;
    right: -22px;
    background-color: #faad14;
    color: #fff;
    padding: 5px 16px;
	.anticon {
		position: absolute;
		top: 38px;
		left: 7px;
		transform: rotate(45deg);
	}
}
`;var y=n(19575);const{Title:L,Text:P,Link:R}=g.A,z=({name:e,title:t,description:n,status:i,notice:l,icon:o,settings_link:c,demo_link:d,doc_link:p,is_pro:m,upgrade_link:g,upgrade:x,deps:v,invalidatePluginList:w})=>{const[_,b]=(0,u.useState)(!1),A=async t=>{b(!0),await(0,y.A)(e,t),w(),b(!1)},R={fontSize:"16px",padding:"6px 14px",marginTop:"20px"};return(0,a.createElement)(k,null,(0,a.createElement)("div",null,(0,a.createElement)("div",{className:"etn-module-card-header"},o&&(0,a.createElement)("img",{src:o,alt:t,style:{width:"50px",height:"50px"}})),(0,a.createElement)("div",null,(0,a.createElement)(L,{level:4,style:{margin:"10px 0",fontSize:"20px"}},t),(0,a.createElement)("div",{className:"etn-card-desc"},(0,a.createElement)("div",{style:{marginBottom:"20px"}},(0,a.createElement)(P,null,n)," ",(0,a.createElement)("br",null),l&&(0,a.createElement)(P,{style:{display:"flex",color:"#ff7129",marginTop:"10px"}},l),(0,a.createElement)("div",{className:"etn-doc-link"},(0,a.createElement)(f.LinkText,{href:p,target:"_blank"},(0,a.createElement)(h.A,null)," ",(0,r.__)("Documentation","eventin")))),"on"==i&&(0,a.createElement)(E.Ay,{variant:E.zB,onClick:()=>{A("install")},target:"_blank",sx:R,loading:_},(0,r.__)("Install","eventin")),"install"==i&&(0,a.createElement)(E.Ay,{variant:E.zB,onClick:()=>{A("activate")},target:"_blank",sx:R,loading:_},(0,r.__)("Activate","eventin")),"upgrade"==i&&x&&(0,a.createElement)(E.Ay,{variant:E.zB,href:g,target:"_blank",sx:R,loading:_},(0,r.__)("Download","eventin")),"activate"==i&&(0,a.createElement)(s.A,{gap:20,wrap:"wrap"},(0,a.createElement)(E.Ay,{variant:E.Vt,onClick:()=>{A("deactivate")},target:"_blank",sx:R,loading:_},(0,r.__)("Deactivate","eventin")),c&&(0,a.createElement)(E.Ay,{variant:E.Vt,target:"_blank",sx:R,href:c},(0,r.__)("Configure","eventin")))))))};var C=n(75063);const B=()=>(0,a.createElement)(x.A,{gutter:[16,16]},[...Array(3)].map(((e,t)=>(0,a.createElement)(v.A,{xs:24,sm:12,md:8,key:t},(0,a.createElement)(_.A,{style:{borderRadius:8}},(0,a.createElement)(C.A.Avatar,{active:!0,size:"large",shape:"circle",style:{marginBottom:16,marginRight:16}}),(0,a.createElement)(C.A.Input,{style:{width:200,marginBottom:8},active:!0}),(0,a.createElement)(C.A,{paragraph:{rows:4}}),(0,a.createElement)("div",{style:{display:"flex",gap:10,alignItems:"center",marginTop:16}},(0,a.createElement)(C.A.Button,{style:{width:100},active:!0}),(0,a.createElement)(C.A.Button,{style:{width:100},active:!0}))))))),M=(0,l.withDispatch)((e=>{const t=e("eventin/global");return{invalidatePluginList:()=>t.invalidateResolution("getPluginList")}})),T=(0,l.withSelect)((e=>({pluginsList:e("eventin/global").getPluginList()}))),I=(0,i.compose)(T,M)((e=>{const{pluginsList:t,invalidatePluginList:n}=e||{},[i,l]=(0,u.useState)(!0);return(0,u.useEffect)((()=>{null!=t&&l(!1)}),[t]),i?(0,a.createElement)(B,null):(0,a.createElement)("div",{className:"etn-module-section"},(0,a.createElement)(x.A,{gutter:[30,30]},t.map((e=>(0,a.createElement)(v.A,{key:e.name,xs:24,sm:12,xl:8},(0,a.createElement)(z,{...e,invalidatePluginList:n}))))))})),{Title:N}=g.A,O=function(e){return(0,a.createElement)("div",{className:"etn-extensions-container"},(0,a.createElement)(A,null,(0,a.createElement)(N,{level:3,className:"etn-extension-title"},(0,r.__)("Plugins List","eventin")),(0,a.createElement)(I,null)))},S=(0,l.withSelect)((e=>{const t=e("eventin/global");return{pluginsList:t.getPluginList(),isPluginsListLoading:t.isResolving("getPluginList")}})),D=(0,i.compose)(S)((function(e){const{pluginsList:t,isPluginsListLoading:n}=e;return(0,a.createElement)(b,{className:"eventin-page-wrapper"},(0,a.createElement)(m,{title:(0,r.__)("Our Plugins","eventin")}),(0,a.createElement)(O,{pluginsList:t,isPluginsListLoading:n}))}))}}]);
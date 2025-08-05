"use strict";(globalThis.webpackChunkwp_event_solution=globalThis.webpackChunkwp_event_solution||[]).push([[802],{15905:(e,t,n)=>{n.d(t,{A:()=>u});var a=n(51609),i=n(75093),r=n(44653),l=n(50300),o=n(69107),c=n(77984),d=n(23495),s=n(4763),m=n(84124);const p=window?.localized_data_obj?.currency_symbol,u=({title:e="Chart",data:t=[],xAxisKey:n="date",yAxisKey:u="revenue"})=>(0,a.createElement)("div",{className:"etn-chart-container",style:{margin:"20px 0"}},(0,a.createElement)("div",{style:{padding:"20px",borderRadius:"8px",border:"1px solid #eee",backgroundColor:"#fff"}},(0,a.createElement)(i.Title,{level:4,style:{marginTop:"20px"}},e),(0,a.createElement)(r.u,{width:"100%",height:300},(0,a.createElement)(l.Q,{data:t,margin:{top:20,right:30,left:20,bottom:5}},(0,a.createElement)("defs",null,(0,a.createElement)("linearGradient",{id:"colorRevenue",x1:"0",y1:"0",x2:"0",y2:"1"},(0,a.createElement)("stop",{offset:"-454.44%",stopColor:"#702CE7",stopOpacity:.4}),(0,a.createElement)("stop",{offset:"76.32%",stopColor:"rgba(107, 46, 229, 0.00)",stopOpacity:0}))),(0,a.createElement)(o.d,{strokeDasharray:"3 3"}),(0,a.createElement)(c.W,{dataKey:n}),(0,a.createElement)(d.h,{tickFormatter:e=>`${p}${e.toLocaleString()}`}),(0,a.createElement)(s.m,{formatter:e=>`${p}${e.toLocaleString()}`}),(0,a.createElement)(m.G,{type:"monotone",dataKey:u,stroke:"#6A2FE4",strokeWidth:3,fill:"url(#colorRevenue)",activeDot:{r:8},animationBegin:0,animationDuration:500,animationEasing:"ease-out"})))))},56765:(e,t,n)=>{n.d(t,{V:()=>p});var a=n(51609),i=n(27723),r=n(71524),l=n(32099),o=n(92911),c=n(16784),d=n(54725),s=n(7638),m=n(48842);const p=({attendees:e,onTicketDownload:t})=>{const n=[{title:(0,i.__)("No.","eventin"),dataIndex:"id",key:"id"},{title:(0,i.__)("Name","eventin"),dataIndex:"etn_name",key:"name",render:(e,t)=>(0,a.createElement)(m.A,null,t?.etn_name," ","trash"===t?.attendee_post_status?(0,a.createElement)(r.A,{color:"#f50"},(0,i.__)("Trashed","eventin")):"")},{title:(0,i.__)("Ticket","eventin"),key:"ticketType",render:(e,t)=>(0,a.createElement)(m.A,null,t?.attendee_seat||t?.ticket_name)},{title:(0,i.__)("Actions","eventin"),key:"actions",width:"10%",align:"center",render:(e,n)=>(0,a.createElement)(l.A,{title:(0,i.__)("View Details and Download Ticket","eventin")},(0,a.createElement)(s.Ay,{variant:s.Vt,onClick:()=>t(n),icon:(0,a.createElement)(d.EyeOutlinedIcon,null),sx:{height:"32px",padding:"4px",width:"32px !important"}}))}];return(0,a.createElement)(a.Fragment,null,(0,a.createElement)(o.A,{justify:"space-between",align:"center",style:{borderBottom:"1px solid #F0F0F0",paddingBottom:"15px"}},(0,a.createElement)(m.A,{sx:{fontWeight:600,fontSize:"18px",color:"#334155"}},(0,i.__)("Attendee List","eventin"))),(0,a.createElement)(c.A,{columns:n,dataSource:e,pagination:!1,rowKey:"id",size:"small",style:{width:"100%"}}))}},3175:(e,t,n)=>{n.d(t,{A:()=>C});var a=n(51609),i=n(27723),r=n(86087),l=n(54725),o=n(7638),c=n(500),d=n(48842),s=n(6836),m=n(905),p=n(69815),u=n(71524),f=n(40372),g=n(92911),x=n(16370),_=n(32099),v=n(47152),y=n(56765);const h=p.default.div`
	padding: 10px 20px;
	background-color: #fff;
`,E=({label:e,value:t,labelSx:n={},valueSx:i={}})=>(0,a.createElement)("div",{style:{margin:"10px 0"}},(0,a.createElement)("div",null,(0,a.createElement)(d.A,{sx:{fontSize:"16px",fontWeight:600,color:"#334155",...n}},e)),(0,a.createElement)("div",null,(0,a.createElement)(d.A,{sx:{fontSize:"16px",fontWeight:400,color:"#334155",...i}},t))),b=(0,p.default)(u.A)`
	border-radius: 20px;
	font-size: 12px;
	font-weight: 600;
	padding: 4px 13px;
	min-width: 80px;
	text-align: center;
	margin: 0px 10px;
`,{useBreakpoint:w}=f.Ay,k={completed:{label:(0,i.__)("Completed","eventin"),color:"success"},failed:{label:(0,i.__)("Failed","eventin"),color:"error"}},A={stripe:"Stripe",wc:"WooCommerce",paypal:"PayPal"},D=({status:e,discountedPrice:t,currencySettings:n})=>{const r=k[e]?.color||"error",l=k[e]?.label||"Failed";return(0,a.createElement)(g.A,{justify:"space-between",align:"center",style:{borderBottom:"1px solid #F0F0F0",paddingBottom:"15px"}},(0,a.createElement)("div",null,(0,a.createElement)(d.A,{sx:{fontWeight:600,fontSize:"18px",color:"#334155"}},(0,i.__)("Billing Information","eventin")),(0,a.createElement)(b,{bordered:!1,color:r},(0,a.createElement)("span",null,l))),(0,a.createElement)(d.A,{sx:{fontWeight:600,fontSize:"18px",color:"#334155"}},(0,m.A)(Number(t),n.decimals,n.currency_position,n.decimal_separator,n.thousand_separator,n.currency_symbol)))},S=({data:e,wooCommerceOrderLink:t})=>(0,a.createElement)(a.Fragment,null,(0,a.createElement)(x.A,{xs:24,md:12},(0,a.createElement)(E,{label:(0,i.__)("Name","eventin"),value:`${e?.customer_fname} ${e?.customer_lname}`||"-"}),(0,a.createElement)(E,{label:(0,i.__)("Email","eventin"),value:e?.customer_email||"-"})),(0,a.createElement)(x.A,{xs:24,md:12},(0,a.createElement)(E,{label:(0,i.__)("Received On","eventin"),value:(0,s.getWordpressFormattedDateTime)(e?.date_time)||"-"}),(0,a.createElement)(E,{label:(0,i.__)("Payment Gateway","eventin"),value:A[e?.payment_method]||"-"}),"wc"===e?.payment_method&&(0,a.createElement)(_.A,{title:(0,i.__)("View Order on WooCommerce","eventin")},(0,a.createElement)(o.Ay,{variant:o.Vt,onClick:()=>window.open(t,"_blank"),icon:(0,a.createElement)(l.EyeOutlinedIcon,null),sx:{height:"32px",padding:"4px",width:"32px !important"}}))),(0,a.createElement)(x.A,{xs:24,md:12},(0,a.createElement)(E,{label:(0,i.__)("Event","eventin"),value:e?.event_name||"-"}))),z=({isDiscounted:e,data:t,discountedPrice:n,currencySettings:r})=>e?(0,a.createElement)(x.A,{xs:24,md:12},(0,a.createElement)(E,{label:(0,i.__)("Total Amount","eventin"),value:(0,m.A)(Number(t?.total_price),r.decimals,r.currency_position,r.decimal_separator,r.thousand_separator,r.currency_symbol)||"-"}),(0,a.createElement)(E,{label:(0,i.__)("Discount","eventin"),value:(0,m.A)(Number(t?.discount_total),r.decimals,r.currency_position,r.decimal_separator,r.thousand_separator,r.currency_symbol)||"-"}),(0,a.createElement)(E,{label:(0,i.__)("Final Amount","eventin"),value:(0,m.A)(Number(n),r.decimals,r.currency_position,r.decimal_separator,r.thousand_separator,r.currency_symbol)||"-"})):null,T=({ticketItems:e})=>(0,a.createElement)(a.Fragment,null,(0,a.createElement)(g.A,{justify:"space-between",align:"center",style:{borderBottom:"1px solid #F0F0F0",paddingBottom:"15px"}},(0,a.createElement)(d.A,{sx:{fontWeight:600,fontSize:"18px",color:"#334155"}},(0,i.__)("Ticket Info","eventin"))),e?.map(((e,t)=>e?.etn_ticket_qty>0&&e?.seats?e?.seats?.map(((e,t)=>(0,a.createElement)(d.A,{key:t}," ",e,(0,a.createElement)("br",null)))):(0,a.createElement)(r.React.Fragment,{key:t},(0,a.createElement)(E,{label:"",value:e?.etn_ticket_name+" X "+e?.etn_ticket_qty||"-"})))));function C(e){const{modalOpen:t,setModalOpen:n,data:r}=e||{},l=Number(r?.discount_total)||0,o=Number(r?.total_price)||0,d=Math.max(0,o-l),m=l>0,p=!w()?.md,u=window?.localized_data_obj||{},f=(0,s.wooOrderLink)(r?.wc_order_id);return(0,a.createElement)(c.A,{centered:!0,title:(0,i.__)("Booking ID","eventin")+" - "+r?.id,open:t,okText:(0,i.__)("Close","eventin"),onOk:()=>n(!1),onCancel:()=>n(!1),width:p?400:700,footer:null,styles:{body:{height:"500px",overflowY:"auto"}},style:{marginTop:"20px"}},(0,a.createElement)(h,null,(0,a.createElement)(D,{status:r?.status,discountedPrice:d,currencySettings:u}),(0,a.createElement)(v.A,{align:"middle",style:{margin:"10px 0"}},(0,a.createElement)(S,{data:r,wooCommerceOrderLink:f}),(0,a.createElement)(z,{isDiscounted:m,data:r,discountedPrice:d,currencySettings:u})),r?.attendees?.length>0?(0,a.createElement)(y.V,{attendees:r?.attendees,onTicketDownload:e=>{let t=`${localized_data_obj.site_url}/etn-attendee?etn_action=download_ticket&attendee_id=${e?.id}&etn_info_edit_token=${e?.etn_info_edit_token}`;window.open(t,"_blank")}}):r?.ticket_items?.length>0&&(0,a.createElement)(T,{ticketItems:r?.ticket_items})))}},32649:(e,t,n)=>{n.d(t,{A:()=>p});var a=n(51609),i=n(54725),r=n(27154),l=n(64282),o=n(86087),c=n(52619),d=n(27723),s=n(19549),m=n(92911);function p(e){const{id:t,apiType:n,modalOpen:p,setModalOpen:u}=e,[f,g]=(0,o.useState)(!1);return(0,a.createElement)(s.A,{centered:!0,title:(0,a.createElement)(m.A,{gap:10,className:"eventin-resend-modal-title-container"},(0,a.createElement)(i.DiplomaIcon,null),(0,a.createElement)("span",{className:"eventin-resend-modal-title"},(0,d.__)("Are you sure?","eventin"))),open:p,onOk:async()=>{g(!0);try{let e;"orders"===n&&(e=await l.A.ticketPurchase.resendTicketByOrder(t),(0,c.doAction)("eventin_notification",{type:"success",message:e?.message}),u(!1)),"attendees"===n&&(e=await l.A.attendees.resendTicketByAttendee(t),(0,c.doAction)("eventin_notification",{type:"success",message:e?.message}),u(!1))}catch(e){console.error("Error in ticket resending!",e),(0,c.doAction)("eventin_notification",{type:"error",message:e?.message})}finally{g(!1)}},confirmLoading:f,onCancel:()=>u(!1),okText:"Send",okButtonProps:{type:"default",className:"eventin-resend-ticket-modal-ok-button",style:{height:"32px",fontWeight:600,fontSize:"14px",color:r.PRIMARY_COLOR,border:`1px solid ${r.PRIMARY_COLOR}`}},cancelButtonProps:{className:"eventin-resend-modal-cancel-button",style:{height:"32px"}},cancelText:"Cancel",width:"344px"},(0,a.createElement)("p",{className:"eventin-resend-modal-description"},(0,d.__)(`Are you sure you want to resend the ${"orders"===n?"Invoice":"Ticket"}?`,"eventin")))}},26115:(e,t,n)=>{n.d(t,{A:()=>C});var a=n(51609),i=n(86087),r=n(27723),l=n(54725),o=n(67313),c=n(64282);const d=window.localized_data_obj?.admin_url,s=[{text:(0,r.__)("Create your first event with date, time & location","eventin"),isVideo:!0,videoLink:"https://www.youtube.com/watch?v=dhSwZ3p02v0&list=PLW54c-mt4ObDwu0GWjJIoH0aP1hQHyKj7&index=13",isDoc:!0,docLink:"https://support.themewinter.com/docs/plugins/plugin-docs/event/eventin-event/"},{text:(0,r.__)("Add attendees & tickets with seat limits & pricing","eventin"),isVideo:!0,videoLink:"https://www.youtube.com/watch?v=XGUdLfRbp00&list=PLW54c-mt4ObDwu0GWjJIoH0aP1hQHyKj7&index=14",isDoc:!0,docLink:"https://support.themewinter.com/docs/plugins/plugin-docs/event/create-event-tickets-free-paid/"},{text:(0,r.__)("Create speakers & organizers for your event page","eventin"),isVideo:!0,videoLink:"https://www.youtube.com/watch?v=Naq6znx-oRg&list=PLW54c-mt4ObDwu0GWjJIoH0aP1hQHyKj7&index=12",isDoc:!0,docLink:"https://support.themewinter.com/docs/plugins/plugin-docs/speakers-and-organizers/eventin-speaker-organizer/"}],m=[{title:(0,r.__)("Setup Wizard","eventin"),completed:!0,buttonText:(0,r.__)("Complete","eventin"),buttonType:"text",buttonLink:`${d}admin.php?page=eventin-setup-wizard`},{title:(0,r.__)("Create event","eventin"),completed:!1,buttonText:(0,r.__)("Create","eventin"),buttonLink:`${d}admin.php?page=eventin#/events/create`},{title:(0,r.__)("Enable Attendees","eventin"),completed:!1,buttonText:(0,r.__)("Go to settings","eventin"),buttonLink:`${d}admin.php?page=eventin#/settings/event-settings/attendees`},{title:(0,r.__)("Create Speakers","eventin"),completed:!1,buttonText:(0,r.__)("Create","eventin"),buttonLink:`${d}admin.php?page=eventin#/speakers/create`},{title:(0,r.__)("Enable Payment","eventin"),completed:!1,buttonText:(0,r.__)("Go to settings","eventin"),buttonLink:`${d}admin.php?page=eventin#/settings/payments/payment_method`}];var p=n(69815),u=n(50400);const f=p.default.div`
	background: #231b49;
	border-radius: 12px;
	padding: 20px;
	margin-bottom: 24px;
	color: #fff;
	position: relative;
`,g=p.default.div`
	display: flex;
	gap: 48px;
	justify-content: space-between;
	flex-wrap: wrap;
	color: #fff;
`,x=p.default.div`
	flex: 1;
	color: #fff;
	max-width: 600px;
`,_=p.default.div`
	flex: 1;
	max-width: 500px;
	background: #5b27c3;
	border-radius: 8px;
	padding: 24px;
`,v=p.default.h2`
	color: #fff;
	font-size: 24px;
	padding: 0;
	margin: 0 0 20px 0;
`,y=p.default.h4`
	color: #fff;
	font-size: 18px;
	margin: 0 0 16px;
`,h=p.default.p`
	color: #fff;
	margin: 0 0 24px;
	font-size: 14px;
`,E=p.default.ul`
	padding: 0;
	margin: 10px 0;
`,b=p.default.li`
	display: flex;
	align-items: center;
	gap: 8px;
	color: #fff;
	margin-bottom: 12px;
	position: relative;
	&::before {
		content: '';
		display: block;
		width: 5px;
		height: 5px;
		background: #fff;
		border-radius: 50%;
	}
	a {
		color: #ff4d97;
		text-decoration: none;
		&:hover {
			text-decoration: underline;
		}
	}
	svg {
		color: #ff4d97;
		font-size: 16px;
	}
`,w=p.default.div`
	display: flex;
	align-items: center;
	justify-content: space-between;
	margin-bottom: 18px;
`,k=p.default.div`
	display: flex;
	align-items: center;
	justify-content: space-between;
	padding: 5px 0;
`,A=p.default.div`
	display: flex;
	align-items: center;
	gap: 12px;
	color: #fff;
	font-size: 16px;
`,D=(0,p.default)(u.Ay)`
	position: absolute;
	top: 16px;
	right: 16px;
	background: transparent;
	border: none;
	color: #fff;
	svg {
		margin-right: -2px;
	}
	&:hover {
		color: #fff !important;
	}
`,S=(0,p.default)(u.Ay)`
	background: transparent;
	color: #fff;
	border-bottom: 1px solid #fff;
	padding: 0px;
	border-radius: 0;
	&:hover {
		background: transparent !important;
		color: #fff !important;
	}
`,z=p.default.div`
	display: flex;
	align-items: center;
	justify-content: space-between;
	margin-bottom: 20px;
`,T=p.default.span`
	@media ( max-width: 500px ) {
		display: none;
	}
`,C=()=>{const[e,t]=(0,i.useState)(!1),[n,d]=(0,i.useState)(null);(0,i.useEffect)((()=>{(async()=>{try{const e=await c.A.setupNotification.getSetupNotification();e&&d(e),e.notification_dismissed?t(!1):t(!0)}catch(e){console.error("Error fetching permissions:",e)}})()}),[]);const p={"Setup Wizard":"wizard_setup","Create event":"event_created","Enable Attendees":"attendees_enabled","Create Speakers":"speakers_created","Enable Payment":"payment_enabled"},u=n&&m?.map((e=>({...e,completed:!!n[p[e.title]]})));return e?(0,a.createElement)(f,null,(0,a.createElement)(z,null,(0,a.createElement)(v,null,(0,r.__)("Welcome to Eventin","eventin")),(0,a.createElement)(D,{onClick:()=>{c.A.setupNotification.dismissSetupNotification({dismissed:!0}),t(!1)},type:"text"},(0,a.createElement)(l.CancelCircle,null),(0,a.createElement)(T,null,(0,r.__)("Dismiss setup","eventin")))),(0,a.createElement)(g,null,(0,a.createElement)(x,null,(0,a.createElement)(y,null,(0,r.__)("To-do List","eventin")),(0,a.createElement)(h,null,(0,r.__)("Set up your event in minutes! From creating events to enabling payments — we’ll walk you through everything you need to launch faster.","eventin")),(0,a.createElement)(E,null,s.map(((e,t)=>(0,a.createElement)(b,{key:t},e.text,e.isVideo&&(0,a.createElement)("a",{href:e.videoLink,target:"_blank",rel:"noopener noreferrer",style:{marginLeft:"8px",color:"#FF4D97",textDecoration:"none"}},(0,a.createElement)(l.PlayCircle,null)," ",(0,r.__)("video","eventin")),e.isDoc&&(0,a.createElement)("a",{href:e.docLink,target:"_blank",rel:"noopener noreferrer",style:{marginLeft:"8px",color:"#FF4D97",textDecoration:"none"}},(0,a.createElement)(l.DraftOutlined,null)," ",(0,r.__)("Doc","eventin"))))))),(0,a.createElement)(_,null,(0,a.createElement)(w,null,(0,a.createElement)(o.A.Text,{style:{fontSize:"18px",fontWeight:"600",color:"#fff",display:"block"}},(0,r.__)("To do list","eventin")),(0,a.createElement)(o.A.Text,{style:{color:"#fff",fontSize:"16px",display:"block"}},n?.total_completed_steps," ",(0,r.__)("/ 5 Completed","eventin"))),u.map(((e,t)=>(0,a.createElement)(k,{key:t},(0,a.createElement)(A,{completed:e.completed},e?.completed?(0,a.createElement)(l.CheckedCircle,null):(0,a.createElement)(l.UncheckedCircle,null),e.title),!e.completed&&(0,a.createElement)(S,{type:"text",size:"small",onClick:()=>{window.location.href=e.buttonLink}},e.buttonText))))))):null}},82802:(e,t,n)=>{n.r(t),n.d(t,{default:()=>Te});var a=n(51609),i=n(86087),r=n(27723),l=n(428),o=n(15905),c=n(26115),d=n(54861),s=n(40372),m=n(47152),p=n(16370),u=n(92911),f=n(75063),g=n(51643),x=n(74353),_=n.n(x),v=n(75093),y=n(6836),h=n(64282),E=n(69815),b=n(77278);E.default.div`
	background-color: #ffffff;
	border-radius: 8px;
	padding: 20px;
	padding-top: 0px;
	margin: 20px 0;
`,E.default.div`
	width: 50%;
	@media ( max-width: 768px ) {
		width: 100%;
	}
`;const w=E.default.div`
	display: flex;
	align-items: center;
	justify-content: flex-end;
	gap: 10px;

	@media ( max-width: 992px ) {
		justify-content: flex-start;
	}
	@media ( max-width: 615px ) {
		flex-direction: column;
		align-items: flex-start;
		justify-content: flex-start;
		margin: 10px 0px;

		.ant-radio-button-wrapper {
			height: 30px;
			font-size: 14px;
			line-height: 30px;
		}
	}
`,k=((0,E.default)(b.A)`
	border-radius: 8px;
	box-shadow: 0 1px 5px rgba( 0, 0, 0, 0.05 );
	padding: 20px;
	@media ( max-width: 768px ) {
		padding: 0px;
	}
`,E.default.div`
	font-size: 16px;
	color: #334155;
	font-weight: 400;

	display: flex;
	align-items: center;
	gap: 12px;
`,E.default.div`
	font-size: 32px;
	font-weight: 600;
	margin-left: 52px;
`,(0,E.default)(m.A)`
	margin: 20px 0;
`),{RangePicker:A}=d.A,{useBreakpoint:D}=s.Ay;function S(e){const{dateRange:t,setDateRange:n}=e,[l,o]=(0,i.useState)(""),[c,d]=(0,i.useState)(!0),s=!D()?.md,x=(0,i.useRef)(!0);return(0,i.useEffect)((()=>{x.current&&((async()=>{try{d(!0);const e=await h.A.user.myProfile();e?.name&&o(e.name)}catch(e){console.log(e)}finally{d(!1)}})(),x.current=!1)}),[]),(0,a.createElement)(m.A,{gutter:10,align:"center",justify:"space-between"},(0,a.createElement)(p.A,{sm:24,md:8},(0,a.createElement)(v.Title,{level:3,sx:{margin:0}},(0,a.createElement)(u.A,{gap:10,align:"center",justify:"start"},(0,a.createElement)("span",null,(0,r.__)("Hello","eventin")),c?(0,a.createElement)(f.A.Input,{active:!0}):(0,a.createElement)("span",{style:{textTransform:"capitalize"}},l,"!")))),(0,a.createElement)(p.A,{sm:24,md:16},(0,a.createElement)(w,null,(0,a.createElement)(A,{size:"large",placeholder:(0,r.__)("Select Date","eventin"),value:[t?.startDate?_()(t?.startDate):null,t?.endDate?_()(t?.endDate):null],onChange:e=>{n({startDate:(0,y.dateFormatter)(e?.[0]||void 0),endDate:(0,y.dateFormatter)(e?.[1]||void 0),predefined:null})},format:(0,y.getDateFormat)(),className:"etn-booking-date-range-picker",style:{width:"100%",width:s?"100%":"250px"}}),(0,a.createElement)(g.Ay.Group,{buttonStyle:"solid",size:"large",value:t?.predefined||"all",className:"etn-filter-radio-group",onChange:e=>n({predefined:e.target.value,startDate:void 0,endDate:void 0})},(0,a.createElement)(g.Ay.Button,{value:"all"},(0,r.__)("All Days","eventin")),(0,a.createElement)(g.Ay.Button,{value:30},(0,r.__)("30 Days","eventin")),(0,a.createElement)(g.Ay.Button,{value:7},(0,r.__)("7 Days","eventin")),(0,a.createElement)(g.Ay.Button,{value:0},(0,r.__)("Today","eventin"))))))}var z=n(54725);const T=E.default.div`
	border-radius: 8px;
	background: linear-gradient( 34deg, #6b2ee5 37.99%, #ff4d97 150.96% );
	padding: 24px;
	width: 100%;
	max-width: 400px;
`,C=E.default.div`
	color: #fff;
	font-size: 16px;
	font-weight: 400;
	line-height: 24px;
	display: flex;
	align-items: center;
	gap: 8px;
	word-wrap: break-word;
	white-space: normal;
`,F=E.default.div`
	color: #fff;
	font-size: 32px;
	font-weight: 600;
	line-height: 32px;
	margin-top: 16px;
	margin-left: 32px;
	word-wrap: break-word;
	white-space: normal;
`,R=E.default.div`
	display: flex;
	align-items: center;
	justify-content: center;
	background: rgba( 255, 255, 255, 0.2 );
	border-radius: 50%;
	width: 32px;
	height: 32px;
`,L=({amount:e=0})=>{const{decimals:t,currency_position:n,decimal_separator:i,thousand_separator:l,currency_symbol:o}=window.localized_data_obj;return(0,a.createElement)(T,null,(0,a.createElement)(C,null,(0,a.createElement)(R,null,(0,a.createElement)(z.RevenueIcon,null)),(0,r.__)("Total Revenue","eventin")),(0,a.createElement)(F,null,(0,y.formatSymbolDecimalsPrice)(e,t,n,i,l,o)))},I=E.default.div`
	border-radius: 8px;
	background: #ffffff;
	padding: 24px;
	width: 100%;
	max-width: 400px;
`,j=E.default.div`
	color: #334155;
	font-size: 16px;
	font-weight: 400;
	line-height: 24px;
	display: flex;
	align-items: center;
	gap: 8px;
	word-wrap: break-word;
	white-space: normal;
`,O=E.default.div`
	color: #020617;
	font-size: 32px;
	font-weight: 600;
	line-height: 32px;
	margin-top: 16px;
	margin-left: 32px;
	word-wrap: break-word;
	white-space: normal;
`,P=E.default.div`
	display: flex;
	align-items: center;
	justify-content: center;
	background: rgba( 255, 255, 255, 0.2 );
	border-radius: 50%;
	width: 32px;
	height: 32px;
`,N=({title:e,amount:t,icon:n})=>{const i=(e=>e>=1e12?(e/1e12).toFixed(2)+"T":e>=1e9?(e/1e9).toFixed(2)+"B":e>=1e6?(e/1e6).toFixed(2)+"M":e.toLocaleString("en-US"))(Number(t));return(0,a.createElement)(I,null,(0,a.createElement)(j,null,(0,a.createElement)(P,null,n),e),(0,a.createElement)(O,null,i))},W=E.default.div`
	padding: 24px;
	width: 100%;
	max-width: 400px;
	height: 128px;
	display: flex;
	flex-direction: column;
	justify-content: space-between;
	border-radius: 8px;
	box-shadow: 0 1px 5px rgba( 0, 0, 0, 0.05 );
	background-color: #ffffff;
`,B=E.default.div`
	display: flex;
	align-items: center;
	gap: 8px;
`,$=E.default.div`
	margin-left: 32px;
`,M=()=>(0,a.createElement)(W,null,(0,a.createElement)(B,null,(0,a.createElement)(f.A.Avatar,{size:32,active:!0}),(0,a.createElement)(f.A.Input,{active:!0,size:"small",style:{width:120}})),(0,a.createElement)($,null,(0,a.createElement)(f.A.Input,{active:!0,size:"large",style:{width:180}}))),Y=e=>{const{data:t,loading:n}=e,{totalEvents:i,totalSpeakers:l,totalAttendee:o,totalRevenue:c}=t,d=[{title:(0,r.__)("Total Events","eventin"),amount:i||0,icon:(0,a.createElement)(z.TotalEventsIcon,null)},{title:(0,r.__)("Total Attendees","eventin"),amount:o||0,icon:(0,a.createElement)(z.TotalParticipantsIcon,null)},{title:(0,r.__)("Total Speakers","eventin"),amount:l||0,icon:(0,a.createElement)(z.TotalSpeakersIcon,null)}];return(0,a.createElement)(k,{gutter:[16,16],justify:"center",align:"middle"},(0,a.createElement)(p.A,{xs:24,sm:12,md:6},n?(0,a.createElement)(M,{active:!0}):(0,a.createElement)(L,{amount:c})),d.map(((e,t)=>(0,a.createElement)(p.A,{key:t,xs:24,sm:12,md:6},n?(0,a.createElement)(M,{active:!0}):(0,a.createElement)(N,{title:e.title,amount:e.amount,icon:e.icon})))))};var V=n(56427),G=n(79664),H=n(18062),K=n(27154);function Q(e){const{title:t}=e,n=E.default.div`
		@media ( max-width: 360px ) {
			display: none;
		}
	`;return(0,a.createElement)(V.Fill,{name:K.PRIMARY_HEADER_NAME},(0,a.createElement)(u.A,{justify:"space-between",align:"center",wrap:"wrap",gap:20},(0,a.createElement)(H.A,{title:t}),(0,a.createElement)("div",{style:{display:"flex",alignItems:"center"}},(0,a.createElement)(u.A,{gap:12},(0,a.createElement)(n,null,(0,a.createElement)(G.A,null))))))}var q=n(51212),J=n(16784),U=n(7638);const X=(0,E.default)(u.A)`
	background-color: #fff;
	padding: 12px 24px;
	border-radius: 12px 12px 0 0;
`;var Z=n(84976),ee=n(18537),te=n(905),ne=n(90070),ae=n(32099),ie=n(17437),re=n(11721),le=n(29491),oe=n(47143),ce=n(52619),de=n(80734),se=n(10962),me=n(32649);const pe=(0,oe.withSelect)((e=>{const t=e("eventin/global");return{settings:t.getSettings(),isSettingsLoading:t.isResolving("getSettings")}})),ue=(0,oe.withDispatch)((e=>({setRevalidateData:e("eventin/global").setRevalidatePurchaseReportList}))),fe=(0,le.compose)([pe,ue])((function(e){const{setRevalidateData:t,record:n,isSettingsLoading:l}=e,[o,c]=(0,i.useState)(!1),d=async()=>{try{await h.A.purchaseReport.deleteOrder(n.id),t(!0),(0,ce.doAction)("eventin_notification",{type:"success",message:(0,r.__)("Successfully deleted the event!","eventin")})}catch(e){console.error("Error deleting the purchase report",e),(0,ce.doAction)("eventin_notification",{type:"error",message:(0,r.__)("Failed to delete the event!","eventin")})}},s=[{label:(0,r.__)("Delete","eventin"),key:"7",icon:(0,a.createElement)(z.DeleteOutlined,{width:"16",height:"16"}),className:"delete-event",onClick:()=>{(0,de.A)({title:(0,r.__)("Are you sure?","eventin"),content:(0,r.__)("Are you sure you want to delete this booking?","eventin"),onOk:d})}}],m=(0,ce.applyFilters)("eventin-pro-booking-list-action-items",s,c,n);return(0,a.createElement)(a.Fragment,null,(0,a.createElement)(ie.mL,{styles:se.S}),(0,a.createElement)(re.A,{menu:{items:m},trigger:["click"],placement:"bottomRight",overlayClassName:"action-dropdown"},(0,a.createElement)(U.Ay,{variant:U.Vt,disabled:l},(0,a.createElement)(z.MoreIconOutlined,{width:"16",height:"16"}))),(0,a.createElement)(me.A,{id:n.id,modalOpen:o,setModalOpen:c,apiType:"orders"}))}));var ge=n(3175);function xe(e){const{record:t}=e,[n,r]=(0,i.useState)(!1);return(0,a.createElement)(a.Fragment,null,(0,a.createElement)(U.Ay,{variant:U.Vt,onClick:()=>r(!0)},(0,a.createElement)(z.EyeOutlinedIcon,{width:"16",height:"16"})),(0,a.createElement)(ge.A,{modalOpen:n,setModalOpen:r,data:t}))}function _e(e){const{record:t}=e;return(0,a.createElement)(ne.A,{size:"small",className:"event-actions"},(0,a.createElement)(ae.A,{title:(0,r.__)("View Details","eventin")},(0,a.createElement)(xe,{record:t})," "),(0,a.createElement)(ae.A,{title:(0,r.__)("More Actions","eventin")},(0,a.createElement)(fe,{record:t})," "))}function ve(e){const{text:t,record:n}=e,i=(0,y.getWordpressFormattedDate)(n?.start_date)+`, ${(0,y.getWordpressFormattedTime)(n?.start_time)} `;return(0,a.createElement)(a.Fragment,null,(0,a.createElement)("span",{className:"event-title"},t),(0,a.createElement)("p",{className:"event-date-time"},n.start_date&&n.start_time&&(0,a.createElement)("span",null,i)))}var ye=n(71524);function he(e){const{status:t}=e,n={pending:{color:"warning",text:"Pending"},processing:{color:"processing",text:"Processing"},hold:{color:"default",text:"Hold"},completed:{color:"success",text:"Completed"},refunded:{color:"default",text:"Refunded"},failed:{color:"error",text:"Failed"}};return(0,a.createElement)(ye.A,{bordered:!1,color:n[t]?.color||"default"},n[t]?.text||t)}const{currency_position:Ee,decimals:be,decimal_separator:we,thousand_separator:ke,currency_symbol:Ae}=window?.localized_data_obj||{},De={wc:"WooCommerce",stripe:"Stripe",paypal:"PayPal",local_payment:"Local Payment"},Se=[{title:(0,r.__)("ID & Date","eventin"),dataIndex:"id",key:"id",width:"12%",render:(e,t)=>(0,a.createElement)(a.Fragment,null,(0,a.createElement)(ve,{text:`#${(0,ee.decodeEntities)(e)}`,record:t}),(0,a.createElement)("span",{className:"event-date-time"}," ",(0,y.getWordpressFormattedDateTime)(t?.date_time)))},{title:(0,r.__)("Name","eventin"),key:"name",dataIndex:"name",width:"18%",render:(e,t)=>(0,a.createElement)("span",null,`${t?.customer_fname} ${t?.customer_lname}`)},{title:(0,r.__)("Email","eventin"),dataIndex:"customer_email",key:"email",width:"20%",render:e=>(0,a.createElement)("span",null,e)},{title:(0,r.__)("Tickets","eventin"),dataIndex:"ticket_items",key:"author",width:"10%",render:(e,t)=>(0,a.createElement)("span",null,`${t?.total_ticket}`)},{title:(0,r.__)("Payment","eventin"),dataIndex:"payment_method",key:"payment_method",width:"10%",render:e=>(0,a.createElement)("span",null,De[e]||"-")},{title:(0,r.__)("Amount","eventin"),dataIndex:"total_price",key:"total_price",width:"10%",render:e=>(0,a.createElement)("span",null,(0,te.A)(Number(e),be,Ee,we,ke,Ae))},{title:(0,r.__)("Status","eventin"),dataIndex:"status",key:"status",width:"12%",render:e=>(0,a.createElement)(he,{status:e})},{title:(0,r.__)("Action","eventin"),key:"action",width:"10%",render:(e,t)=>(0,a.createElement)(_e,{record:t})}],ze=function(){const[e,t]=(0,i.useState)(!0),[n,l]=(0,i.useState)(null),o=(0,i.useRef)(!0);return(0,i.useEffect)((()=>{o.current&&((async()=>{try{t(!0);const e=await h.A.purchaseReport.ordersByEvent({per_page:10,paged:1}),n=await(e?.json());l(n)}catch(e){console.log(e)}finally{t(!1)}})(),o.current=!1)}),[]),(0,a.createElement)(a.Fragment,null,(0,a.createElement)(X,{justify:"space-between",align:"center",gap:10,wrap:"wrap",className:"eventin-dashboard-booking-table-title-container"},(0,a.createElement)(v.Title,{level:4,style:{marginTop:"20px"}},(0,r.__)("Recent Bookings","eventin")," "),(0,a.createElement)(Z.Link,{to:"/purchase-report"},(0,a.createElement)(U.Ay,{variant:U.zB,style:{width:"100%"}},(0,r.__)("View All","eventin")))),(0,a.createElement)(J.A,{loading:e,columns:Se,dataSource:n,scroll:{x:1e3},sticky:{offsetHeader:100},pagination:!1}))},Te=()=>{const[e,t]=(0,i.useState)(!0),[n,d]=(0,i.useState)(null),[s,m]=(0,i.useState)({}),p=(0,i.useRef)(!0),u=async()=>{try{t(!0);const e=await h.A.reports.getReports((()=>{if("all"===s?.predefined)return{start_date:void 0,end_date:void 0};if(0===s?.predefined)return{start_date:_()().format("YYYY-MM-DD"),end_date:_()().format("YYYY-MM-DD")};if(!s?.predefined)return{start_date:s?.startDate,end_date:s?.endDate};const e=_()().format("YYYY-MM-DD");return{start_date:_()().subtract(s?.predefined,"day").format("YYYY-MM-DD"),end_date:e}})()),n=await(e?.json());d(n)}catch(e){console.error(e)}finally{t(!1)}};return(0,i.useEffect)((()=>{p.current&&(p.current=!1,u())}),[]),(0,i.useEffect)((()=>{Object.keys(s).length>0&&u()}),[s]),(0,i.useEffect)((()=>{document.body?.classList?.remove("folded")}),[]),(0,a.createElement)("div",null,(0,a.createElement)(Q,{title:(0,r.__)("Dashboard","eventin")}),(0,a.createElement)(q.f,null,(0,a.createElement)(c.A,null),(0,a.createElement)(S,{dateRange:s,setDateRange:m}),(0,a.createElement)(Y,{loading:e,data:{totalEvents:n?.event,totalSpeakers:n?.speaker,totalAttendee:n?.attendee,totalRevenue:n?.revenue}}),(0,a.createElement)(l.A,{spinning:e},(0,a.createElement)(o.A,{title:(0,r.__)("Booking Performance","eventin"),data:n?.date_reports||[],xAxisKey:"date",yAxisKey:"revenue"})),(0,a.createElement)(ze,null)))}},51212:(e,t,n)=>{n.d(t,{f:()=>a});const a=n(69815).default.div`
	background-color: #f4f6fa;
	padding: 12px 32px;
	min-height: 100vh;
	@media ( max-width: 768px ) {
		padding: 10px 20px;
	}
	.ant-table-wrapper {
		padding: 15px 30px;
		background-color: #fff;
		border-radius: 0 0 12px 12px;
	}

	.event-list-wrapper {
		border-radius: 0 0 12px 12px;
	}

	.ant-table-thead {
		> tr {
			> th {
				background-color: #fff;
				padding-top: 10px;
				font-weight: 600;
				color: #7a7a99;
				font-size: 16px;
				&:before {
					display: none;
				}
			}
		}
	}

	tr {
		&:hover {
			background-color: #f8fafc !important;
		}
	}

	.event-title {
		color: #262626;
		font-size: 16px;
		font-weight: 600;
		line-height: 26px;
		display: inline-flex;
		margin-bottom: 6px;
	}

	.event-location,
	.event-date-time {
		color: #334155;
		font-weight: 400;
		margin: 0;
		line-height: 1.4;
		font-size: 14px;
	}
	.event-date-time {
		display: flex;
		align-items: center;
		gap: 4px;
	}

	.event-location {
		margin-bottom: 4px;
	}

	.event-actions {
		.ant-btn {
			padding: 0;
			width: 28px;
			height: 28px;
			line-height: 1;
			display: flex;
			justify-content: center;
			align-items: center;
			border-color: #94a3b8;
			color: #525266;
			background-color: #f5f5f5;
		}
	}

	.ant-tag {
		border-radius: 20px;
		font-size: 12px;
		font-weight: 400;
		padding: 4px 13px;
		min-width: 80px;
		text-align: center;
	}

	.ant-tag.event-category {
		background-color: transparent;
		font-size: 16px;
		color: #334155;
		font-wight: 400;
		padding: 0;
		text-align: left;
	}

	.author {
		font-size: 16px;
		color: #334155;
		font-wight: 400;
		text-transform: capitalize;
	}
	.recurring-badge {
		background-color: #1890ff1a;
		color: #1890ff;
		font-size: 12px;
		padding: 5px 12px;
		border-radius: 50px;
		font-weight: 600;
		margin-inline: 10px;
	}
`}}]);
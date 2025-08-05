"use strict";(globalThis.webpackChunkwp_event_solution=globalThis.webpackChunkwp_event_solution||[]).push([[655],{34590:(e,t,n)=>{n.d(t,{A:()=>g});var a=n(51609),i=n(27723),r=n(67313),o=n(5556),l=n.n(o),d=n(54725),s=n(10012),c=n(72397),u=n(59292);const{Title:m,Text:p}=r.A;function g({form:e}){return(0,a.createElement)(a.Fragment,null,(0,a.createElement)("div",{style:{marginBottom:"40px"}},(0,a.createElement)(m,{level:3,style:{fontWeight:600,margin:"0 0 8px 0",fontSize:"26px",lineHeight:"32px",color:"#111827"}},(0,i.__)("Create your new event","eventin")),(0,a.createElement)(p,{style:{fontSize:"14px",color:"#6B7280",display:"block"}},(0,i.__)("Create your event step-by-step. Don’t worry, you can make changes later.","eventin"))),(0,a.createElement)(m,{level:4,style:{fontWeight:600,margin:"0 0 24px 0",fontSize:"18px",color:"#111827",display:"flex",alignItems:"center",gap:"8px"}},(0,a.createElement)(d.ListOutlinedBorder,{style:{color:"#6366F1"}})," ",(0,i.__)("Basic Information","eventin")),(0,a.createElement)(s.QN,{label:(0,i.__)("Event Title","eventin"),name:"title",required:!0,contextId:"eventin-event-title",tokenType:"short",tooltip:(0,i.__)("Enter a clear name for your event, like “WordCamp US 2025”","eventin"),form:e,rules:[{required:!0,message:(0,i.__)("Event title is required","eventin")}]}),(0,a.createElement)(c.A,{dateRange:"date_range",startDate:"start_date",startTime:"start_time",endDate:"end_date",endTime:"end_time",form:e,tooltip:(0,i.__)("Choose the start and end date of your event. For single-day events, both can be the same.","eventin")}),(0,a.createElement)(u.A,{form:e,unitName:"recurrence_freq",intervalName:"recurrence_daily_interval",checkBoxName:"recurring_enabled",eventEnds:"recurrence_ends_on"}))}g.propTypes={form:l().object.isRequired}},86121:(e,t,n)=>{n.d(t,{A:()=>f});var a=n(51609),i=n(56427),r=n(27723),o=n(92911),l=n(69815),d=n(5556),s=n.n(d),c=n(27154),u=n(54725),m=n(7638),p=n(79664),g=n(18062);const v=l.default.div`
	@media ( max-width: 460px ) {
		display: none;
	}
`;function f({onNavigateBack:e}){return(0,a.createElement)(i.Fill,{name:c.PRIMARY_HEADER_NAME},(0,a.createElement)(o.A,{justify:"space-between",align:"center",gap:10,wrap:"wrap"},(0,a.createElement)(o.A,{align:"center",gap:16},(0,a.createElement)(m.Ay,{variant:m.Vt,icon:(0,a.createElement)(u.AngleLeftIcon,null),sx:{height:"36px",width:"36px",backgroundColor:"#fafafa",borderColor:"transparent",lineHeight:"1"},onClick:e}),(0,a.createElement)(g.A,{title:(0,r.__)("Create New Event","eventin")})),(0,a.createElement)(v,null,(0,a.createElement)(p.A,null))))}f.propTypes={onNavigateBack:s().func.isRequired}},72576:(e,t,n)=>{n.d(t,{A:()=>f});var a=n(51609),i=n(27723),r=n(47152),o=n(16370),l=n(60742),d=n(92911),s=n(5556),c=n.n(s),u=n(7638),m=n(38224),p=n(86121),g=n(34590),v=n(98492);function f({form:e,isLoading:t,handleSubmit:n,handleClose:s,onNavigateBack:c}){return(0,a.createElement)("div",null,(0,a.createElement)(p.A,{onNavigateBack:c}),(0,a.createElement)(m.nx,null,(0,a.createElement)(m.d0,null,(0,a.createElement)(r.A,{gutter:[16,10],justify:"center",className:"eventin-create-event-form"},(0,a.createElement)(o.A,{xl:12,lg:18,md:20,xs:24,className:"eventin-create-event-form-container"},(0,a.createElement)(l.A,{form:e,name:"event-create-form",layout:"vertical",autoComplete:"on",onFinish:n,scrollToFirstError:!0,size:"large"},(0,a.createElement)(g.A,{form:e}),(0,a.createElement)(v.A,{form:e}),(0,a.createElement)(d.A,{gap:12,justify:"end",style:{margin:"42px 0px 0",padding:"24px 0 0",borderTop:"1px solid #E5E7EB"}},(0,a.createElement)(u.Ay,{variant:u.Vt,onClick:s,sx:{fontSize:"16px",fontWeight:"600",height:"44px",lineHeight:"1",color:"#262626",padding:"8px 24px"}},(0,i.__)("Cancel","eventin")),(0,a.createElement)(u.Ay,{variant:u.zB,loading:t,htmlType:"submit",sx:{fontSize:"16px",fontWeight:"600",height:"44px",lineHeight:"1"}},(0,i.__)("Create Event","eventin")))))))))}f.propTypes={form:c().object.isRequired,isLoading:c().bool.isRequired,handleSubmit:c().func.isRequired,handleClose:c().func.isRequired,onNavigateBack:c().func.isRequired}},25491:(e,t,n)=>{n.d(t,{A:()=>m});var a=n(86087),i=n(52619),r=n(27723),o=n(60742),l=n(74353),d=n.n(l),s=n(47767),c=n(64282),u=n(6836);function m({setShouldRevalidateEventList:e,setTotalCount:t}){const[n,l]=(0,a.useState)(!1),[m]=o.A.useForm(),p=(0,s.useNavigate)(),g=!!window.etn_buddyboss_ajax,v=g&&window.etn_buddyboss_ajax?.group_id;return{form:m,isLoading:n,handleSubmit:async()=>{const n={...m.getFieldsValue(!0)},a=n?.date_range,o={start_date:d()(a[0]).format("YYYY-MM-DD"),end_date:d()(a[1]).format("YYYY-MM-DD")},s=(0,u.dateFormatter)(o.start_date),f=(0,u.dateFormatter)(o.end_date),_=n.location,{address:x,place_id:h,latitude:E,longitude:y,...b}=Object.assign({},_);"offline"===n?.event_type&&(n.location={address:x?.toString()||"",place_id:h,latitude:E,longitude:y}),"online"===n?.event_type&&("custom_url"!==b?.integration&&(b.custom_url=""),n.location=b),l(!0);const A=m.getFieldValue(["event_recurrence","recurrence_custom"]),w=Array.isArray(A)?A.map((e=>d()(e).format("YYYY-MM-DD"))):[],k={...n,timezone:Intl.DateTimeFormat().resolvedOptions().timeZone,start_date:s,end_date:f,recurring_enabled:n.recurring_enabled?"yes":"no",event_type:n.event_type||"offline",event_recurrence:{...n.event_recurrence,recurrence_custom:w||[]}};g&&(k._etn_buddy_group_id=v);try{const n=await c.A.events.createEvent(k);t(1),e(!0),p(`${n?.id}/basic`),(0,i.doAction)("eventin_notification",{type:"success",message:(0,r.__)("Event Created successfully","eventin")})}catch(e){console.error("Something went wrong while creating event!"),console.error(e),(0,i.doAction)("eventin_notification",{type:"error",message:(0,r.__)("Couldn't Create Event!","eventin")})}finally{l(!1)}},handleClose:()=>{p("/events")},initialValues:{interval_unit:"days",event_type:"offline"}}}},98492:(e,t,n)=>{n.d(t,{A:()=>u});var a=n(51609),i=n(27723),r=n(67313),o=n(5556),l=n.n(o),d=n(54725),s=n(75613);const{Title:c}=r.A;function u({form:e}){return(0,a.createElement)(a.Fragment,null,(0,a.createElement)(c,{level:4,style:{fontSize:"18px",fontWeight:600,margin:"24px 0 22px 0"}},(0,a.createElement)(d.LocationOutlinedAlt,{width:18,height:18})," ",(0,i.__)("Event Type","eventin")),(0,a.createElement)(s.A,{form:e}))}u.propTypes={form:l().object.isRequired}},18655:(e,t,n)=>{n.r(t),n.d(t,{default:()=>s});var a=n(51609),i=n(29491),r=n(47143),o=n(25491),l=n(72576);const d=(0,r.withDispatch)((e=>{const t=e("eventin/global");return{setShouldRevalidateEventList:e=>{t.setRevalidateEventList(e),t.invalidateResolution("getEventList")},setTotalCount:e=>t.setTotalEvents(e)}})),s=(0,i.compose)(d)((function(e){const{setShouldRevalidateEventList:t,setTotalCount:n}=e,{form:i,isLoading:r,handleSubmit:d,handleClose:s,initialValues:c}=(0,o.A)({setShouldRevalidateEventList:t,setTotalCount:n});return(0,a.createElement)(l.A,{form:i,isLoading:r,handleSubmit:d,handleClose:s,onNavigateBack:()=>s(),initialValues:c})}))},38224:(e,t,n)=>{n.d(t,{WO:()=>o,d0:()=>r,nx:()=>i,oY:()=>l});var a=n(98869);const i=a.default.div`
	background: #f3f5f7;
	padding: 20px 0;
	min-height: calc( 100vh - 60px );
	margin-top: -20px;
`,r=a.default.div`
	background: #ffffff;
	border: 1px solid #e1e4e9;
	border-radius: 8px;
	margin: 40px;
	padding: 40px;
	@media screen and ( max-width: 1350px ) and ( min-width: 1200px ) {
		margin: 20px;
		padding: 20px 0px;
	}
	@media ( max-width: 768px ) {
		padding: 20px;
		margin: 0px;
	}
`,o=a.default.button`
	display: flex;
	align-items: center;
	height: 46px;
	gap: 8px;
	padding: 8px 16px;
	font-size: 16px;
	font-weight: 500;
	background: #f9f5ff;
	border: none;
	border-radius: 6px;
	cursor: pointer;
	position: relative;
	transition: all 0.2s ease;
	svg {
		color: #ff69b4;
	}
`,l=a.default.span`
	background: linear-gradient(
		90deg,
		#fc8327 0%,
		#e83aa5 50.5%,
		#3a4ff2 100%
	);
	-webkit-background-clip: text;
	-webkit-text-fill-color: rgba( 0, 0, 0, 0 );
	background-clip: text;
`}}]);
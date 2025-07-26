"use strict";(globalThis.webpackChunkwp_event_solution=globalThis.webpackChunkwp_event_solution||[]).push([[758],{2959:(e,t,n)=>{n.d(t,{A:()=>b});var a=n(51609),l=n(27723),i=n(17437),r=n(67313),s=n(60742),o=n(36492),c=n(51643),m=n(38181),d=n(54861),u=n(74353),_=n.n(u),p=n(5019),g=n(10012),f=n(6836);const{Text:x,Title:v}=r.A,b=function(e){const{attendeeExtraFields:t,parentKey:n}=e;return(0,a.createElement)("div",{className:"etn-extra-fields-container"},(0,a.createElement)(i.mL,{styles:i.AH`
					.etn-extra-form-field {
						.ant-form-item-extra {
							font-size: 14px;
							font-style: italic;
							margin-bottom: 10px;
							letter-spacing: 0.5px;
						}
					}
				`}),t?.map(((e,t,i)=>(0,a.createElement)("div",{className:"etn-extra-form-field",key:t},function(e){const t=e?.label?.toLowerCase()?.replace(/\s+/g,"_"),i=n?["attendees",n,"extra_fields",t]:["extra_fields",t];switch(e?.field_type){case"text":return(0,a.createElement)(g.ks,{label:e?.label,name:i,placeholder:(0,l.__)(`${e?.placeholder_text||""}`,"eventin"),size:"large",type:"text",required:e?.required,extra:e?.additional_text,rules:[{required:e?.required,message:(0,l.__)(`${e?.label} is required!`,"eventin")}]});case"textarea":return(0,a.createElement)(g.No,{label:e?.label,name:i,placeholder:e?.placeholder_text||"",type:"textarea",extra:e?.additional_text,rows:3,cols:50,required:e?.required,className:"etn-extra-field-text-area",rules:[{required:e?.required,message:(0,l.__)(`${e?.label} is required!`,"eventin")}]});case"number":return(0,a.createElement)(s.A.Item,{label:e?.label,name:i,placeholder:e?.placeholder_text||"",extra:e?.additional_text,rules:[{required:e?.required,message:(0,l.__)(`${e?.label} is required!`,"eventin")}],required:e?.required},(0,a.createElement)(p.A,{placeholder:e?.placeholder_text||"",className:"etn-extra-field-number"}));case"select":return(0,a.createElement)(s.A.Item,{label:e?.label,name:i,extra:e?.additional_text,rules:[{required:e?.required,message:(0,l.__)(`${e?.label} is required!`,"eventin")}],required:e?.required},(0,a.createElement)(o.A,{placeholder:e?.placeholder_text||"",size:"large",options:e?.field_options,allowClear:!0,className:"etn-extra-field-select"}));case"radio":return(0,a.createElement)(s.A.Item,{label:e?.label,name:i,extra:e?.additional_text,rules:[{required:e?.required,message:(0,l.__)(`${e?.label} is required!`,"eventin")}]},(0,a.createElement)(c.Ay.Group,{className:"etn-radio-group"},e?.field_options?e?.field_options?.map(((e,t)=>(0,a.createElement)(c.Ay,{key:t,value:e.value},e.value))):null));case"checkbox":return(0,a.createElement)(s.A.Item,{label:e?.label,name:i,extra:e?.additional_text,rules:[{required:e?.required,message:(0,l.__)(`${e?.label} is required!`,"eventin")}]},(0,a.createElement)(m.A.Group,{className:"etn-checkbox-group"},e?.field_options?.map(((e,t)=>(0,a.createElement)(m.A,{key:t,value:e?.value},e?.value)))));case"date":return(0,a.createElement)(s.A.Item,{label:e?.label,name:i,getValueProps:e=>({value:e?_()(e):null}),normalize:e=>e?_()(e).format("YYYY-MM-DD"):e,extra:e?.additional_text,rules:[{required:e?.required,message:(0,l.__)(`${e?.label} is required!`,"eventin")}]},(0,a.createElement)(d.A,{size:"large",style:{width:"100%"},format:(0,f.getDateFormat)()}));default:return null}}(e)))))}},25758:(e,t,n)=>{n.r(t),n.d(t,{default:()=>Fe});var a=n(51609),l=n(56427),i=n(27723),r=n(92911),s=n(47767),o=n(69815),c=n(54725),m=n(7638),d=n(79664),u=n(18062),_=n(27154),p=n(29491),g=n(47143),f=n(86087),x=n(52619),v=n(67313),b=n(60742),h=n(428),E=n(64282),k=n(47152),y=n(16370),A=n(38181),w=n(75093),q=n(2959),N=n(10012);const S=e=>{const{form:t,ticketKey:n,attendeeExtraFields:l,settings:r}=e,[s,o]=(0,f.useState)(),{reg_require_email:c,reg_require_phone:m,default_extra_fields:d}=r||{},u="on"===c,_="on"===m;return(0,f.useEffect)((()=>{if(d&&Array.isArray(d)){const e=d?.map((e=>({...e,name:e.name.replace(/^etn_/,"")})));o(e)}}),[d]),(0,a.createElement)(a.Fragment,null,Array.isArray(s)?s?.map(((e,t)=>{if(e?.show)return(0,a.createElement)(N.ks,{key:e.name+t,label:(0,i.__)(`${e.label}`,"eventin"),name:["attendees",n,e.name],rules:[{required:e.required,message:e.label+(0,i.__)(" is required!","eventin")},"email"===e.name&&{required:e?.required,type:"email",message:(0,i.__)("Please enter a valid email address","eventin")},"phone"===e.name&&{pattern:new RegExp(/^[+]?[\d\s()-]+$/),message:(0,i.__)("Please enter a valid phone number","eventin")}].filter(Boolean),required:e.required,placeholder:e.placeholder_text,size:"large"})})):(0,a.createElement)(a.Fragment,null,(0,a.createElement)(N.ks,{label:(0,i.__)("Name","eventin"),name:["attendees",n,"name"],placeholder:(0,i.__)("Enter Full Name","eventin"),size:"large",rules:[{required:!0,message:(0,i.__)("Name is Required!","eventin")}],required:!0,className:"eventin-attendee-name"}),u&&(0,a.createElement)(N.ks,{label:(0,i.__)("Email","eventin"),name:["attendees",n,"email"],placeholder:(0,i.__)("Enter your email","eventin"),size:"large",rules:[{type:"email",required:!0,message:(0,i.__)("Enter Valid Email!","eventin")}],required:!0,className:"eventin-attendee-email"}),_&&(0,a.createElement)(N.ks,{label:(0,i.__)("Phone","eventin"),name:["attendees",n,"phone"],placeholder:(0,i.__)("+01234567490","eventin"),rules:[{required:!0,message:(0,i.__)("Phone is Required!","eventin")},{pattern:new RegExp(/^[+]?[\d\s()-]+$/),message:(0,i.__)("Please enter a valid phone number","eventin")}],required:!0,className:"eventin-attendee-phone"})," "),l&&(0,a.createElement)(q.A,{parentKey:n,attendeeExtraFields:l,className:"eventin-extra-form-fields"}))},z=e=>{const{form:t,extraFields:n,settings:l}=e,[r,s]=(0,f.useState)({}),o=t.getFieldValue("ticketCounts"),c=(0,f.useMemo)((()=>JSON.parse(localStorage.getItem("etn_cart_seat_plan")||"{}")),[]),m=b.A.useWatch("customer_fname",{form:t,preserve:!0}),d=b.A.useWatch("customer_lname",{form:t,preserve:!0});(0,f.useEffect)((()=>{const e=o||{},t=c?.selectedSeats;c?(Object.values(e).forEach((e=>{t?.[e.name]&&(e.quantity=t?.[e.name].length)})),s(e)):s(e)}),[o,c]);const u="on"===l?.enable_attendee_bulk;return(0,a.createElement)(a.Fragment,null,(0,a.createElement)(w.Title,{level:4},(0,i.__)("Attendee Details","eventin")),u&&(0,a.createElement)(A.A,{className:"eventin-bulk-attendee-checkbox",valuePropName:"checked",onChange:e=>{e.target.checked?(()=>{const e=`${m} ${d||""}`,n=Boolean(m),a=t.getFieldValue("customer_email"),i=Boolean(a),s=t.getFieldValue("customer_phone"),o=Boolean(s);Object.keys(r).map((c=>[...Array(r[c].quantity)].map(((r,m)=>{l?.default_extra_fields&&Array.isArray(l?.default_extra_fields)?t.setFieldsValue({attendees:{[c+"#dynamic_id"+m+1]:{name:l?.default_extra_fields[0].show?`${n?e:"Attendee"}`:"",email:l?.default_extra_fields[1].show?i?a:"attendee@example.com":"",phone:l?.default_extra_fields[2].show?o?s:"+1234567890":""}}}):t.setFieldsValue({attendees:{[c+"#dynamic_id"+m+1]:{name:n?e:"Attendee",email:"on"===l?.reg_require_email?i?a:"attendee@example.com":"",phone:"on"===l?.reg_require_phone?o?s:"+1234567890":""}}})}))))})():t.setFieldValue("attendees",void 0)},style:{marginBottom:"16px",fontWeight:"500"}},(0,i.__)("Enable Bulk Attendee","eventin")),Object.keys(r).map((e=>(0,a.createElement)("div",{key:e},[...Array(r[e].quantity)].map(((s,o)=>(0,a.createElement)("div",{className:"eventin-form-card-container",key:o},(0,a.createElement)(w.Text,{style:{fontWeight:"500"}},(0,i.__)("Attendee","eventin")," ",o+1," ("+r[e].name+")"),(0,a.createElement)(S,{className:"eventin-form-field-list",form:t,settings:l,attendeeExtraFields:n,ticketKey:e+"#dynamic_id"+o+1}))))))))},F={background:"#ffffff","&:hover":{borderColor:_.PRIMARY_COLOR_SETTING},"&:focus":{borderColor:_.PRIMARY_COLOR_SETTING,boxShadow:"none"}},T=e=>{const{settings:t}=e,n=t?.show_phone_number,l=t?.require_last_name;return(0,a.createElement)(a.Fragment,null,(0,a.createElement)(w.Title,{level:4,style:{marginTop:"0px"}},(0,i.__)("Billing Information","eventin")),(0,a.createElement)(k.A,{gutter:[16,0]},(0,a.createElement)(y.A,{xs:24,sm:24,md:12},(0,a.createElement)(N.ks,{label:(0,i.__)("First Name","eventin"),name:"customer_fname",placeholder:(0,i.__)("Enter First Name","eventin"),size:"large",rules:[{required:!0,message:(0,i.__)("First Name is Required!","eventin")}],required:!0,className:"etn-billing-form-first-name",sx:F})),(0,a.createElement)(y.A,{xs:24,sm:24,md:12},(0,a.createElement)(N.ks,{label:(0,i.__)("Last Name","eventin"),name:"customer_lname",placeholder:(0,i.__)("Enter Last Name","eventin"),size:"large",rules:[{required:!!l,message:(0,i.__)("Last Name is Required!","eventin")}],required:!!l,className:"etn-billing-form-last-name",style:F})),(0,a.createElement)(y.A,{xs:24,sm:24,md:12},(0,a.createElement)(N.ks,{label:(0,i.__)("Email","eventin"),name:"customer_email",placeholder:(0,i.__)("Enter Email Address","eventin"),size:"large",rules:[{type:"email",required:!0,message:(0,i.__)("Enter Valid Email!","eventin")}],required:!0,className:"etn-billing-form-email"})),n&&(0,a.createElement)(y.A,{xs:24,sm:24,md:12},(0,a.createElement)(N.ks,{label:(0,i.__)("Phone","eventin"),name:"customer_phone",placeholder:(0,i.__)("Enter Phone Number","eventin"),size:"large",rules:[{validator:async(e,t)=>{if(!t)return;const n=t.replace(/\D/g,"");if(!/^\+?([0-9]{1,3})?[-. ]?\(?([0-9]{1,4})\)?[-. ]?([0-9]{1,4})[-. ]?([0-9]{1,4})$/.test(t))throw new Error("Please enter a valid phone number!");if(n.length<8||n.length>15)throw new Error("Phone number must be between 8 and 15 digits!")}}],className:"etn-billing-form-phone"}))))};var C=n(18537),P=n(52741),$=n(48842),j=n(57237),I=n(6836),R=n(905),L=n(51643);const M=o.default.div`
	background: #f3f5f7;
	min-height: calc( 100vh - 60px );
	padding-top: 5px;
`,B=o.default.div`
	border: 1px solid #e1e4e9;
	border-radius: 8px;
	padding: 20px;
	background: #ffffff;
	margin: 30px;
`,V=o.default.div`
	width: 100%;
	max-width: 950px;
	margin: 0 auto;
	padding: 20px;
`,O=o.default.div`
	position: relative;
`,W=o.default.div`
	display: flex;
	justify-content: space-between;
	margin-top: 16px;
	font-size: 16px;
`,D=o.default.div`
	display: flex;
	justify-content: flex-end;
	gap: 20px;
	border-top: 1px solid #e8e8e8;
	margin-top: 20px;
	padding: 20px;
`,Y=o.default.div`
	background-color: #f7faff;
	padding: 30px;
	max-width: 480px;
	border: 1px solid #02061714;
	border-radius: 10px;
	position: sticky;
	top: 100px;
	left: 0;
`,G=o.default.div`
	display: flex;
	flex-direction: column;
	margin-bottom: 16px;
	gap: 10px;
`,H=o.default.div`
	display: flex;
	justify-content: space-between;
	margin-bottom: 8px;
`,K=o.default.div`
	display: flex;
	justify-content: space-between;
	font-weight: bold;
	margin-top: 18px;
`,Q=(0,o.default)(L.Ay.Group)`
	width: 100%;
	display: flex;
	align-items: center;
	gap: 10px;
	@media ( max-width: 850px ) {
		flex-wrap: wrap;
	}
	.ant-radio-wrapper {
		width: 180px;
		background: #ffffff;
		padding: 10px 15px;
		border: 1px solid #f0f0f0;
		border-radius: 10px;
		cursor: pointer;
		.ant-radio-checked .ant-radio-inner {
			background-color: #6b2ee5 !important;
			border-color: #6b2ee5 !important;
		}
		&:hover {
			border-color: #6b2ee5 !important;
		}
		&.ant-radio-wrapper-checked.ant-radio-wrapper-in-form-item {
			border-color: #6b2ee5 !important;
		}
	}
`,J=o.default.div`
	.etn-ticket-header {
		margin: 0 20px;
	}
`,U=e=>{const{form:t,settings:n}=e,l=b.A.useWatch("event_data",{form:t,preserve:!0}),r=t.getFieldValue("ticketCounts"),s=b.A.useWatch("total_price",{form:t,preserve:!0}),{currency_position:o="left",decimals:m=2,decimal_separator:d=".",thousand_separator:u=",",currency_symbol:_="$"}=n,p="woocommerce"===window?.localized_data_obj?.payment_option_woo,g=`${(0,I.getWordpressFormattedDate)(l?.start_date)}, ${(0,I.getWordpressFormattedTime)(l?.start_time)}`,f=(Number(s),(0,I.getLocationInfo)(l?.location)),x=(0,C.decodeEntities)(l?.title||"");return(0,a.createElement)(Y,null,(0,a.createElement)(j.A,{level:4,style:{fontSize:"22px",margin:"0 0 20px 0"}},(0,i.__)(x,"eventin")),(0,a.createElement)(G,null,(0,a.createElement)($.A,null,(0,a.createElement)(c.CalendarIcon,{width:18,height:18})," ",g),f&&(0,a.createElement)($.A,null,(0,a.createElement)(c.LocationOutlined,{width:18,height:18})," ",(0,C.decodeEntities)(f))),(0,a.createElement)(P.A,{style:{borderColor:"#E5EFFF"}}),(0,a.createElement)(j.A,{level:5,style:{fontSize:"18px",marginBottom:"10px",fontWeight:"500"}},(0,i.__)("Booking Summary","eventin")),r&&Object?.entries(r).map((([e,t])=>t.quantity<=0?null:(0,a.createElement)(H,{key:e},(0,a.createElement)("div",null,(0,a.createElement)("span",null,(0,C.decodeEntities)(t.name)," X"," ",t.quantity)),(0,a.createElement)("span",null,(0,R.A)(t.quantity*t.price,m,o,d,u,_,p))))),(0,a.createElement)(K,null,(0,a.createElement)("span",null,(0,i.__)("Total","eventin")),(0,a.createElement)("span",null,(0,R.A)(s,m,o,d,u,_,p))))},X=e=>{const{form:t,settings:n}=e;return localized_data_obj,n.etn_sells_engine_stripe,(0,a.createElement)(a.Fragment,null,(0,a.createElement)(w.Title,{level:4,className:"eventin-billing-title"},(0,i.__)("Payment Information","eventin")),(0,a.createElement)(k.A,{gutter:[16,0]},(0,a.createElement)(y.A,{xs:24,sm:24},(0,a.createElement)(b.A.Item,{label:(0,i.__)("Payment Method","eventin"),name:"payment_method",rules:[{required:!0,message:(0,i.__)("Please select payment method!","eventin")}]},(0,a.createElement)(Q,null,(0,a.createElement)(L.Ay,{value:"local_payment",className:"etn-payment-button"},(0,i.__)("Local Payment","eventin")))))))},Z=e=>{const{form:t,settings:n}=e,l=t.getFieldValue("event_data"),i=t.getFieldValue("total_price"),r=Number(i)<=0,s=!!localized_data_obj?.payment_option_woo,o="stripe"===n.etn_sells_engine_stripe,c=n?.paypal_status,m=s||o||c,d=l?.extra_fields?.length>0?l?.extra_fields:n?.extra_fields,u="on"===n?.attendee_registration;return(0,a.createElement)(O,null,(0,a.createElement)(k.A,{gutter:[24,0]},(0,a.createElement)(y.A,{xs:24,sm:24,md:14},(0,a.createElement)(T,{settings:n,form:t}),u&&(0,a.createElement)(z,{settings:n,form:t,extraFields:d}),!r&&m&&(0,a.createElement)(X,{form:t,settings:n})),(0,a.createElement)(y.A,{xs:24,sm:24,md:10},(0,a.createElement)(U,{settings:n,form:t}))))};var ee=n(77278),te=n(31058),ne=n(90070);(0,o.default)(ee.A)`
	border-radius: 8px;
	box-shadow: 0px 0px 30px rgba( 0, 0, 0, 0.03 );
`,(0,o.default)(k.A)`
	margin-bottom: 16px;
	padding: 8px;
	border: 1px solid #d9d9d9;
	border-radius: 4px;
	transition: border-color 0.3s;

	&:hover,
	&:focus-within {
		border-color: #1890ff;
	}
`,(0,o.default)(v.A.Text)`
	font-size: 16px;
	color: #4e7ffd;
	font-weight: 700;
`,(0,o.default)(v.A.Text)`
	font-size: 16px;
	font-weight: bold;
`,(0,o.default)(k.A)`
	margin-top: 16px;
	margin-bottom: 16px;
`;const ae=(0,o.default)(m.Ay)`
	text-align: center;
	color: #d9d9d9 !important;
	&:focus {
		background-color: transparent !important;
	}

	&:disabled {
		background-color: #0206170a;
		&:hover {
			background-color: transparent !important;
		}
	}
`,le=(0,o.default)(te.A)`
	input {
		text-align: center !important;
		padding-top: 5px !important;
	}
`,ie=((0,o.default)(te.A)`
	width: ${e=>Math.max(40,17*String(e.value).length)}px;
	input {
		padding: 0px 5px !important;
	}
`,(0,o.default)(m.Ay)`
	width: 100%;
	transition: all 0.3s ease;
	height: 50px;
	margin-top: 10px;
	background-color: ${e=>e.backgroundColor} !important;
	border: 1px solid ${e=>e.backgroundColor} !important;
	&:disabled {
		background-color: #d9d9d9 !important;
		border: none !important;
	}
`,(0,o.default)(k.A)`
	background-color: #f4f5f8;
	margin-bottom: 15px;
	padding: 20px 10px;
	border-radius: 6px;
`),re=(0,o.default)(k.A)`
	width: 100%;
	border-bottom: 1px dashed gray;
	padding: 10px 0px;
`,se=o.default.span`
	font-size: 16px;
	font-weight: 700;
	color: ${e=>e.color} !important;
`,oe=o.default.span`
	color: #6d6e77;
	font-weight: 400;
	font-size: 0.8125rem;
`,ce=((0,o.default)(k.A)`
	width: 100%;
	padding: 10px 0px;
`,o.default.div`
	color: #525259;
	font-weight: 600;
	font-size: 12px;
	padding-bottom: 10px;
`),me=o.default.div`
	font-size: 1rem;
`,de=(0,o.default)(ne.A.Compact)`
	&.etn-ticket-quantity {
		background-color: #fff;
		color: #6d6e77;
		border: 1px solid #d9d9d9;
		border-radius: 4px;
		padding: 0;

		.etn-ticket-selection-btn {
			display: flex;
			justify-content: center;
			align-items: center;
			.ant-btn-icon {
				color: #0a1018;
			}
		}

		.ant-input-number-sm input.ant-input-number-input {
			height: 32px;
			padding: 5px;
		}
		.ant-input-number {
			width: 40px;
			border: none;
		}
	}
`;var ue=n(82654),_e=n(32099),pe=n(74353),ge=n.n(pe),fe=n(83826),xe=n.n(fe),ve=n(88569),be=n.n(ve);ge().extend(xe()),ge().extend(be());const he=(e,t)=>{const n=(e=>{try{return ge()().tz(e),!0}catch(e){return!1}})(t),a=ge().tz.guess(),l=n?t:a,{sellable:i,message:r,type:s}=(0,I.isTicketSellable)(e,l);return{show:!i,message:r,hideSelector:!i,type:s||"error"}},Ee=(e,t)=>{const n=t[e.etn_ticket_slug]?.quantity||0;if(n>=e.etn_min_ticket&&n<=e.etn_max_ticket){const t={show:!1,message:"",hideSelector:!1};return n===e.etn_min_ticket?t.reason="min":n===e.etn_max_ticket&&(t.reason="max"),t}return e.etn_min_ticket&&n&&n<e.etn_min_ticket?{show:!0,message:(0,i.__)("Minimum ticket quantity is ","eventin")+e.etn_min_ticket,reason:"min",hideSelector:!1}:e.etn_max_ticket&&n>e.etn_max_ticket?{show:!0,message:(0,i.__)("Maximum ticket quantity is ","eventin")+e.etn_max_ticket,reason:"max",hideSelector:!1}:{show:!1,message:"",hideSelector:!1}},ke=(e,t)=>{const n=t[e.etn_ticket_slug]?.quantity||0,a=e.etn_avaiilable_tickets-e.etn_sold_tickets;return null!==e.etn_avaiilable_tickets&&n===a?{show:!1,message:"",hideSelector:!1,limitExceeded:!0}:null!==e.etn_avaiilable_tickets&&n>a?{show:!0,message:(0,i.__)("Tickets are no longer available","eventin"),hideSelector:!1}:{show:!1,message:"",hideSelector:!1}},ye=e=>{var t;const{ticket:n,timezone:l,ticketCounts:r,handleUpdateTicketCount:s,isPaymentMethodError:o,settingsData:d,isFrontend:u=!0}=e;if(!1===n?.etn_enable_ticket)return null;const p="on"===localized_data_obj?.etn_hide_seats_from_details,g=d?.show_ticket_expiry_date,f=(()=>{const e=Math.abs(n?.etn_sold_tickets-n?.etn_avaiilable_tickets);if(null===n?.etn_avaiilable_tickets)return null;if(e<1)return{type:"error",message:(0,i.__)("All tickets have been sold out!","eventin")};const t=he(n,l);if(t.show)return{type:t?.type,message:t?.message,hideSelector:t?.hideSelector};const a=Ee(n,r);if(a.show)return{type:"error",message:a.message};const s=ke(n,r);return s.show?{type:"error",message:s.message}:null})();f?localStorage.setItem("etn_ticket_select_alert",JSON.stringify(f)):localStorage.removeItem("etn_ticket_select_alert");const{currency_position:x,decimals:v,decimal_separator:b,thousand_separator:h}=window.localized_data_obj,E=window.localized_data_obj?.currency_symbol,A="woocommerce"===window?.localized_data_obj?.payment_option_woo,w=n?.etn_avaiilable_tickets,q=null!==(t=n?.etn_sold_tickets)&&void 0!==t?t:0;return(0,a.createElement)(ie,{gutter:[8,16],align:"middle",className:"etn-ticket-container"},(0,a.createElement)(re,{className:"etn-ticket-header"},(0,a.createElement)(y.A,{xs:24,style:{paddingBottom:"10px"}},(0,a.createElement)(se,{color:u?_.PRIMARY_COLOR_SETTING:"#334155",className:"etn-ticket-title"},(0,a.createElement)("div",null,n?.etn_ticket_name," ",!p&&!f?.hideSelector&&(0,a.createElement)(oe,{className:"etn-remaining-seats"},"(","number"==typeof w?Math.max(w-q,0):"∞"," ",(0,i.__)("seats remaining","eventin"),")")),n?.etn_ticket_description&&(0,a.createElement)("div",null,(0,a.createElement)(oe,{className:"etn-ticket-description",style:{color:"#3e3e3e"}},n?.etn_ticket_description)),(0,a.createElement)("div",null,g&&!f?.hideSelector&&(0,a.createElement)(oe,{className:"etn-ticket-sale-end-date"},(0,i.__)("Sale ends on: ","eventin"),(0,I.getWordpressFormattedDateTime)(`${n?.end_date} ${n?.end_time}`)))))),f&&(0,a.createElement)(ue.A,{type:f.type,message:f.message,style:{width:"100%",textAlign:"center",fontSize:"14px"},className:"etn-ticket-alert"}),o&&Number(n?.etn_ticket_price)>0&&(0,a.createElement)(ue.A,{type:"error",style:{width:"100%",textAlign:"center",fontSize:"14px"},message:(0,i.__)("Payment methods are not enabled for this event!","eventin"),className:"etn-payment-error-alert"}),!f?.hideSelector&&(0,a.createElement)(k.A,{justify:"space-between",align:"top",style:{width:"100%",textAlign:"center"},className:"etn-ticket-info-row"},(0,a.createElement)(y.A,{sm:6,className:"etn-ticket-price-col"},(0,a.createElement)(ce,{className:"etn-ticket-price-label"},(0,i.__)("Ticket Price:","eventin")),(0,a.createElement)(me,{className:"etn-ticket-price"},(0,a.createElement)("strong",null,(0,R.A)(Number(n.etn_ticket_price),v,x,b,h,E,A)))),(0,a.createElement)(y.A,{sm:12,className:"etn-ticket-quantity-col"},(0,a.createElement)(ce,{className:"etn-ticket-quantity-label"},(0,i.__)("Quantity","eventin")),(0,a.createElement)(de,{align:"center",className:"etn-ticket-quantity"},(0,a.createElement)(_e.A,{title:"min"===Ee(n,r)?.reason&&(0,i.__)("Minimum Quantity Reached!","eventin")},(0,a.createElement)(ae,{variant:m.pz,icon:(0,a.createElement)(c.MinusIcon,null),className:"etn-ticket-selection-btn",onClick:()=>{const e=n?.etn_min_ticket,t=n?.etn_max_ticket;let a=r[n.etn_ticket_slug].quantity-1;e&&a<e?a=0:t&&a>t&&(a=t),s(n.etn_ticket_slug,a)},disabled:r[n.etn_ticket_slug].quantity<1||he(n,l).show})),(0,a.createElement)(le,{size:"small",className:"etn-ticket-quantity-input",hide:!0,controls:!1,min:0,value:r[n.etn_ticket_slug]?.quantity,onChange:e=>s(n.etn_ticket_slug,e),disabled:he(n,l).show}),(0,a.createElement)(_e.A,{title:"max"===Ee(n,r)?.reason&&(0,i.__)("Maximum Quantity Reached!","eventin")},(0,a.createElement)(ae,{variant:m.pz,className:"etn-ticket-selection-btn",icon:(0,a.createElement)(c.PlusIcon,null),disabled:null!==n?.etn_avaiilable_tickets&&(he(n,l).show||"max"===Ee(n,r)?.reason||ke(n,r)?.limitExceeded||ke(n,r).show||Math.abs(n?.etn_sold_tickets-n?.etn_avaiilable_tickets)<1),onClick:()=>{let e;const t=n?.etn_min_ticket,a=n?.etn_max_ticket,l=r[n.etn_ticket_slug].quantity;e=t&&l<t?t:a&&l>a?a:l+1,s(n.etn_ticket_slug,e)}})))),(0,a.createElement)(y.A,{sm:6,className:"etn-ticket-subtotal-col"},(0,a.createElement)(ce,{className:"etn-ticket-subtotal-label"},(0,i.__)("Subtotal:","eventin")),(0,a.createElement)(me,{className:"etn-ticket-subtotal"},(0,a.createElement)("strong",null,(0,R.A)(Number(n.etn_ticket_price)*r[n.etn_ticket_slug]?.quantity,v,x,b,h,E,A))))))};var Ae=n(36492);const we=e=>{const{form:t,eventList:n,settings:l}=e,[r,s]=(0,f.useState)(null),[o,c]=(0,f.useState)({}),m=b.A.useWatch("event_id",{form:t,preserve:!0}),{currency_position:d="left",decimals:u=2,decimal_separator:_=".",thousand_separator:p=",",currency_symbol:g="$"}=l||{},x="woocommerce"===window?.localized_data_obj?.payment_option_woo,v=n&&n?.items.map((e=>({value:e.id,label:e.title})));(0,f.useEffect)((()=>{m&&n?.items?.map((e=>{e.id==m&&(s(e),c((e=>{const t={};return e.forEach((e=>{t[e.etn_ticket_slug]={name:e.etn_ticket_name,slug:e.etn_ticket_slug,price:Number(e.etn_ticket_price),quantity:0}})),t})(e?.ticket_variations||[])),t.setFieldsValue({event_data:e,event_id:e?.id}))}))}),[m]);const h=r?.ticket_variations,E=Boolean(r?.enable_seatmap),A=(e,t)=>{c((n=>((e,t,n)=>({...n,[e]:{...n[e],quantity:Math.max(0,t)}}))(e,t,n)))},q=o&&Object.values(o)?.reduce(((e,t)=>e+(t?.quantity||0)),0),N=h&&h?.reduce(((e,t)=>e+Number(t.etn_ticket_price)*(o[t.etn_ticket_slug]?.quantity||0)),0);(0,f.useEffect)((()=>{t.setFieldsValue({ticketCounts:o,total_quantity:q,total_price:N})}),[o,q,N]);const S=Boolean(r?.ticket_variations&&r?.ticket_variations?.length>0);return(0,a.createElement)(k.A,{gutter:[16,0]},(0,a.createElement)(y.A,{xs:24,md:24},(0,a.createElement)(b.A.Item,{label:(0,i.__)("Select Event","eventin"),name:"event_id"},(0,a.createElement)(Ae.A,{options:v,showSearch:!0,optionFilterProp:"label",size:"large",placeholder:(0,i.__)("Select Event","eventin")}))),(0,a.createElement)(y.A,{xs:24,md:24},r&&h&&!E&&h?.map((e=>(0,a.createElement)(J,null,(0,a.createElement)(ye,{key:e?.etn_ticket_slug,ticket:e,timezone:r?.timezone,ticketCounts:o,handleUpdateTicketCount:A,isFrontend:!1}))))),(0,a.createElement)(y.A,{xs:24,md:24},r&&!E&&!S&&(0,a.createElement)(w.AlertNotice,{title:(0,i.__)("No ticket variations added yet.","eventin"),description:(0,i.__)("This event doesn’t have any tickets. You need to add tickets to let people book.","eventin"),buttonText:(0,i.__)("Create Tickets","eventin"),redirectUrl:`${window.localized_data_obj.site_url}/wp-admin/admin.php?page=eventin#/events/create/${m}/tickets`})),(0,a.createElement)(y.A,{xs:24,md:24},r&&h&&E&&(0,a.createElement)(ue.A,{message:(0,i.__)("Visual Seat Map is currently unavailable for admin bookings.","eventin"),type:"info"})),(0,a.createElement)(y.A,{xs:24,md:24},h&&h?.length>0&&(0,a.createElement)(W,null,(0,a.createElement)(w.Text,{style:{fontSize:"16px",fontWeight:"bold"}},(0,i.__)("Total Quantity: ","eventin")," ",(0,a.createElement)("strong",null,q)),(0,a.createElement)(w.Text,{style:{fontSize:"16px",fontWeight:"bold"}},(0,i.__)("Total Price: ","eventin")," ",(0,a.createElement)("strong",null,(0,I.formatSymbolDecimalsPrice)(N,u,d,_,p,g,x))))))},{Title:qe,Text:Ne}=v.A,Se=(0,g.withSelect)((e=>{const t=e("eventin/global");return{settings:t.getSettings(),isSettingsLoading:t.isResolving("getSettings"),eventList:t.getEventList(),isLoading:t.isResolving("getEventList")}})),ze=(0,p.compose)(Se)((function(e){const{isLoading:t,isSettingsLoading:n,settings:l,eventList:o}=e,[c,d]=(0,f.useState)(0),[u,_]=(0,f.useState)(!1),[p]=b.A.useForm(),g=(0,s.useNavigate)(),[v,k]=(0,f.useState)(!0),y=b.A.useWatch("total_quantity",{form:p,preserve:!0}),A=b.A.useWatch("total_price",{form:p,preserve:!0}),w=Number(A)<=0;(0,f.useEffect)((()=>{k(!(y&&y>0))}),[y]);const q=JSON.parse(localStorage.getItem("etn_ticket_select_alert")),N=Boolean(q),S="on"===l?.attendee_registration,z=(localized_data_obj,t||n),F=[{title:"Step 1",content:(0,a.createElement)(we,{form:p,eventList:o,settings:l})},{title:"Step 2",content:(0,a.createElement)(Z,{form:p,settings:l,select:!0})}];return(0,a.createElement)(M,null,(0,a.createElement)(B,null,(0,a.createElement)(V,null,(0,a.createElement)("div",{style:{marginBottom:"40px"}},(0,a.createElement)(qe,{level:3,style:{fontWeight:600,margin:"0 0 8px 0",fontSize:"26px",lineHeight:"32px",color:"#111827"}},(0,i.__)("Create your new booking","eventin")),(0,a.createElement)(Ne,{style:{fontSize:"14px",color:"#6B7280",display:"block"}},(0,i.__)("Add booking details below to create a new booking quickly and easily.","eventin"))),z?(0,a.createElement)(r.A,{justify:"center",align:"center",style:{minHeight:"320px"}},(0,a.createElement)(h.A,null)):(0,a.createElement)(b.A,{layout:"vertical",form:p,scrollToFirstError:!0,size:"large",onFinish:async()=>{_(!0);try{await p.validateFields();const e=p.getFieldsValue(!0),t=p.getFieldValue("payment_method"),n=p.getFieldValue("ticketCounts"),a=S?Object.entries(e?.attendees)?.map((([e,t])=>({email:t?.email,name:t?.name,phone:t?.phone,ticket_slug:e?.split("#dynamic_id")?.[0],extra_fields:t?.extra_fields,link:t?.link}))):[],l=Object.keys(n)?.map((e=>({ticket_slug:e,ticket_quantity:n[e].quantity}))),r=l.filter((e=>e.ticket_quantity>0));let s=w?"free-ticket":null;s=t||s;const{event_data:o,ticketCounts:c,...m}=e,d={...m,tickets:r,attendees:a,payment_method:s},u=await E.A.ticketPurchase.createOrder(d);if(!u?.id)throw new Error("Couldn't create attendee properly!");await E.A.ticketPurchase.paymentComplete({order_id:u?.id,payment_status:"success",payment_method:s}),g("/purchase-report"),(0,x.doAction)("eventin_notification",{type:"success",message:(0,i.__)("Successfully created the booking!","eventin")})}catch(e){(0,x.doAction)("eventin_notification",{type:"error",message:e.message})}finally{_(!1)}}},(0,a.createElement)("div",{style:{marginTop:"20px"}},F[c].content),(0,a.createElement)(D,null,0===c&&(0,a.createElement)(m.Ay,{variant:m.Rm,htmlType:"reset",onClick:()=>g("/purchase-report")},(0,i.__)("Back","eventin")),0===c&&(0,a.createElement)(m.Ay,{variant:m.zB,loading:u,onClick:()=>d(c+1),disabled:v||N},(0,i.__)("Save & Next","eventin")),c>0&&(0,a.createElement)(m.Ay,{variant:m.Rm,htmlType:"reset",onClick:()=>d(c-1)},(0,i.__)("Previous","eventin")),c===F.length-1&&(0,a.createElement)(m.Ay,{variant:m.zB,loading:u,htmlType:"submit"},(0,i.__)("Book","eventin")))))))})),Fe=function(){const e=(0,s.useNavigate)(),t=o.default.div`
		@media ( max-width: 400px ) {
			display: none;
			border: 1px solid red;
		}
	`;return(0,a.createElement)("div",null,(0,a.createElement)(l.Fill,{name:_.PRIMARY_HEADER_NAME},(0,a.createElement)(r.A,{justify:"space-between",align:"center",wrap:"wrap",gap:20},(0,a.createElement)(r.A,{align:"center",gap:16},(0,a.createElement)(m.Ay,{variant:m.Vt,icon:(0,a.createElement)(c.AngleLeftIcon,null),sx:{height:"36px",width:"36px",backgroundColor:"#fafafa",borderColor:"transparent",lineHeight:"1"},onClick:()=>{e("/purchase-report")}}),(0,a.createElement)(u.A,{title:(0,i.__)("Event Bookings","eventin")})),(0,a.createElement)(t,null,(0,a.createElement)(d.A,null)))),(0,a.createElement)(ze,null))}}}]);
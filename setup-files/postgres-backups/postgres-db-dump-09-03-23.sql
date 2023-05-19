--
-- PostgreSQL database dump
--

-- Dumped from database version 15.2
-- Dumped by pg_dump version 15.1

-- Started on 2023-03-09 22:55:51

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 223 (class 1259 OID 16433)
-- Name: application; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.application (
    applicationid integer NOT NULL,
    carid integer NOT NULL,
    staff_approval_id integer,
    astatus character varying(20) NOT NULL,
    creationdate date NOT NULL,
    decisiondate date,
    avalue money NOT NULL,
    customerid integer NOT NULL
);


ALTER TABLE public.application OWNER TO postgres;

--
-- TOC entry 222 (class 1259 OID 16432)
-- Name: application_applicationid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.application_applicationid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.application_applicationid_seq OWNER TO postgres;

--
-- TOC entry 3370 (class 0 OID 0)
-- Dependencies: 222
-- Name: application_applicationid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.application_applicationid_seq OWNED BY public.application.applicationid;


--
-- TOC entry 219 (class 1259 OID 16414)
-- Name: car; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.car (
    carid integer NOT NULL,
    cname character varying(30) NOT NULL,
    price money NOT NULL
);


ALTER TABLE public.car OWNER TO postgres;

--
-- TOC entry 218 (class 1259 OID 16413)
-- Name: car_carid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.car_carid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.car_carid_seq OWNER TO postgres;

--
-- TOC entry 3371 (class 0 OID 0)
-- Dependencies: 218
-- Name: car_carid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.car_carid_seq OWNED BY public.car.carid;


--
-- TOC entry 215 (class 1259 OID 16400)
-- Name: customer; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.customer (
    customerid integer NOT NULL,
    fname character varying(20) NOT NULL,
    sname character varying(25) NOT NULL,
    email character varying(30) NOT NULL,
    phone character varying(25) NOT NULL,
    pwd character varying(255) NOT NULL
);


ALTER TABLE public.customer OWNER TO postgres;

--
-- TOC entry 214 (class 1259 OID 16399)
-- Name: customer_customerID_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public."customer_customerID_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."customer_customerID_seq" OWNER TO postgres;

--
-- TOC entry 3372 (class 0 OID 0)
-- Dependencies: 214
-- Name: customer_customerID_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."customer_customerID_seq" OWNED BY public.customer.customerid;


--
-- TOC entry 221 (class 1259 OID 16421)
-- Name: document; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.document (
    documentid integer NOT NULL,
    customerid integer NOT NULL,
    applicationid integer NOT NULL,
    dtype character varying(30) NOT NULL,
    dlocation character varying(255) NOT NULL
);


ALTER TABLE public.document OWNER TO postgres;

--
-- TOC entry 220 (class 1259 OID 16420)
-- Name: document_documentid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.document_documentid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.document_documentid_seq OWNER TO postgres;

--
-- TOC entry 3373 (class 0 OID 0)
-- Dependencies: 220
-- Name: document_documentid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.document_documentid_seq OWNED BY public.document.documentid;


--
-- TOC entry 217 (class 1259 OID 16407)
-- Name: staff; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.staff (
    staffid integer NOT NULL,
    fname character varying(25) NOT NULL,
    sname character varying(25) NOT NULL,
    email character varying(50) NOT NULL,
    pwd character varying(255) NOT NULL,
    code text,
    codetime integer
);


ALTER TABLE public.staff OWNER TO postgres;

--
-- TOC entry 216 (class 1259 OID 16406)
-- Name: staff_staffid_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.staff_staffid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.staff_staffid_seq OWNER TO postgres;

--
-- TOC entry 3374 (class 0 OID 0)
-- Dependencies: 216
-- Name: staff_staffid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.staff_staffid_seq OWNED BY public.staff.staffid;


--
-- TOC entry 3197 (class 2604 OID 16436)
-- Name: application applicationid; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.application ALTER COLUMN applicationid SET DEFAULT nextval('public.application_applicationid_seq'::regclass);


--
-- TOC entry 3195 (class 2604 OID 16417)
-- Name: car carid; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.car ALTER COLUMN carid SET DEFAULT nextval('public.car_carid_seq'::regclass);


--
-- TOC entry 3193 (class 2604 OID 16403)
-- Name: customer customerid; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.customer ALTER COLUMN customerid SET DEFAULT nextval('public."customer_customerID_seq"'::regclass);


--
-- TOC entry 3196 (class 2604 OID 16424)
-- Name: document documentid; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.document ALTER COLUMN documentid SET DEFAULT nextval('public.document_documentid_seq'::regclass);


--
-- TOC entry 3194 (class 2604 OID 16410)
-- Name: staff staffid; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.staff ALTER COLUMN staffid SET DEFAULT nextval('public.staff_staffid_seq'::regclass);


--
-- TOC entry 3364 (class 0 OID 16433)
-- Dependencies: 223
-- Data for Name: application; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.application (applicationid, carid, staff_approval_id, astatus, creationdate, decisiondate, avalue, customerid) FROM stdin;
18	2	1	declined	2023-02-27	2023-02-28	£42,000.00	17
19	4	1	approved	2023-02-27	2023-02-28	£80,000.00	17
22	1	1	approved	2023-03-09	2023-03-09	£142,400.00	17
\.


--
-- TOC entry 3360 (class 0 OID 16414)
-- Dependencies: 219
-- Data for Name: car; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.car (carid, cname, price) FROM stdin;
4	Peel P50	£80,000.00
3	Tesla Model S Plaid	£110,000.00
2	Golf R "20 Years"	£42,000.00
1	Porsche Taycan Turbo S	£142,400.00
\.


--
-- TOC entry 3356 (class 0 OID 16400)
-- Dependencies: 215
-- Data for Name: customer; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.customer (customerid, fname, sname, email, phone, pwd) FROM stdin;
17	Zoe	Angela	za@gmail.com	+44 7295 372015	password!
18	Mr	Test	1@1.com	111111111	pass
19	Ronald	McDonald	r.mcd@gmail.com	+44 192838901	pass
\.


--
-- TOC entry 3362 (class 0 OID 16421)
-- Dependencies: 221
-- Data for Name: document; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.document (documentid, customerid, applicationid, dtype, dlocation) FROM stdin;
12	17	18	image	63fca3f6072d72.11145907.jpeg
13	17	19	image	63fcb7cf772475.86707951.jpeg
15	17	22	image	640a13946e0404.14083785.jpeg
\.


--
-- TOC entry 3358 (class 0 OID 16407)
-- Dependencies: 217
-- Data for Name: staff; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.staff (staffid, fname, sname, email, pwd, code, codetime) FROM stdin;
1	Adam	Adminson	global.finance.mail.a@gmail.com	admin	\N	\N
\.


--
-- TOC entry 3375 (class 0 OID 0)
-- Dependencies: 222
-- Name: application_applicationid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.application_applicationid_seq', 22, true);


--
-- TOC entry 3376 (class 0 OID 0)
-- Dependencies: 218
-- Name: car_carid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.car_carid_seq', 1, false);


--
-- TOC entry 3377 (class 0 OID 0)
-- Dependencies: 214
-- Name: customer_customerID_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."customer_customerID_seq"', 19, true);


--
-- TOC entry 3378 (class 0 OID 0)
-- Dependencies: 220
-- Name: document_documentid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.document_documentid_seq', 15, true);


--
-- TOC entry 3379 (class 0 OID 0)
-- Dependencies: 216
-- Name: staff_staffid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.staff_staffid_seq', 1, true);


--
-- TOC entry 3207 (class 2606 OID 16438)
-- Name: application pk_application; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.application
    ADD CONSTRAINT pk_application PRIMARY KEY (applicationid);


--
-- TOC entry 3203 (class 2606 OID 16419)
-- Name: car pk_car; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.car
    ADD CONSTRAINT pk_car PRIMARY KEY (carid);


--
-- TOC entry 3199 (class 2606 OID 16405)
-- Name: customer pk_customer; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.customer
    ADD CONSTRAINT pk_customer PRIMARY KEY (customerid);


--
-- TOC entry 3205 (class 2606 OID 16426)
-- Name: document pk_document; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.document
    ADD CONSTRAINT pk_document PRIMARY KEY (documentid);


--
-- TOC entry 3201 (class 2606 OID 16412)
-- Name: staff pk_staff; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.staff
    ADD CONSTRAINT pk_staff PRIMARY KEY (staffid);


--
-- TOC entry 3210 (class 2606 OID 16439)
-- Name: application fk_application_car; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.application
    ADD CONSTRAINT fk_application_car FOREIGN KEY (carid) REFERENCES public.car(carid);


--
-- TOC entry 3211 (class 2606 OID 16471)
-- Name: application fk_application_customer; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.application
    ADD CONSTRAINT fk_application_customer FOREIGN KEY (customerid) REFERENCES public.customer(customerid) NOT VALID;


--
-- TOC entry 3212 (class 2606 OID 16444)
-- Name: application fk_application_staff; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.application
    ADD CONSTRAINT fk_application_staff FOREIGN KEY (staff_approval_id) REFERENCES public.staff(staffid);


--
-- TOC entry 3208 (class 2606 OID 16449)
-- Name: document fk_document_application; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.document
    ADD CONSTRAINT fk_document_application FOREIGN KEY (applicationid) REFERENCES public.application(applicationid) NOT VALID;


--
-- TOC entry 3209 (class 2606 OID 16427)
-- Name: document fk_document_customer; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.document
    ADD CONSTRAINT fk_document_customer FOREIGN KEY (customerid) REFERENCES public.customer(customerid);


-- Completed on 2023-03-09 22:55:51

--
-- PostgreSQL database dump complete
--


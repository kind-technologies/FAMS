--
-- PostgreSQL database dump
--

-- Started on 2009-07-06 22:14:05 IST

SET client_encoding = 'UTF8';
SET standard_conforming_strings = off;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;

SET search_path = public, pg_catalog;

DROP INDEX public.aro_aco_key;
ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
ALTER TABLE ONLY public.system_menus DROP CONSTRAINT system_menu_pkey;
ALTER TABLE ONLY public.employees DROP CONSTRAINT employees_pkey;
ALTER TABLE ONLY public.divisions DROP CONSTRAINT divisions_pkey;
ALTER TABLE ONLY public.branches DROP CONSTRAINT branches_pkey;
ALTER TABLE ONLY public.aros DROP CONSTRAINT aros_pkey;
ALTER TABLE ONLY public.aros_acos DROP CONSTRAINT aros_acos_pkey;
ALTER TABLE ONLY public.acos DROP CONSTRAINT acos_pkey;
ALTER TABLE public.users ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.system_menus ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.employees ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.divisions ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.branches ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.aros_acos ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.aros ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.acos ALTER COLUMN id DROP DEFAULT;
DROP SEQUENCE public.users_id_seq;
DROP SEQUENCE public.system_menu_id_seq;
DROP SEQUENCE public.employees_id_seq;
DROP SEQUENCE public.divisions_id_seq;
DROP SEQUENCE public.branches_id_seq;
DROP SEQUENCE public.aros_id_seq;
DROP SEQUENCE public.aros_acos_id_seq;
DROP SEQUENCE public.acos_id_seq;
DROP TABLE public.users;
DROP TABLE public.system_menus;
DROP TABLE public.employees;
DROP TABLE public.divisions;
DROP TABLE public.branches;
DROP TABLE public.aros_acos;
DROP TABLE public.aros;
DROP TABLE public.acos;
DROP SCHEMA public;
--
-- TOC entry 3 (class 2615 OID 2200)
-- Name: public; Type: SCHEMA; Schema: -; Owner: -
--

CREATE SCHEMA public;


--
-- TOC entry 1813 (class 0 OID 0)
-- Dependencies: 3
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: -
--

COMMENT ON SCHEMA public IS 'standard public schema';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 1490 (class 1259 OID 16396)
-- Dependencies: 1771 1772 3
-- Name: acos; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE acos (
    id integer NOT NULL,
    parent_id integer,
    model character varying(255) DEFAULT NULL::character varying,
    foreign_key integer,
    alias character varying(255) DEFAULT NULL::character varying,
    lft integer,
    rght integer
);


--
-- TOC entry 1492 (class 1259 OID 16409)
-- Dependencies: 1774 1775 3
-- Name: aros; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE aros (
    id integer NOT NULL,
    parent_id integer,
    model character varying(255) DEFAULT NULL::character varying,
    foreign_key integer,
    alias character varying(255) DEFAULT NULL::character varying,
    lft integer,
    rght integer
);


--
-- TOC entry 1494 (class 1259 OID 16422)
-- Dependencies: 1777 1778 1779 1780 3
-- Name: aros_acos; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE aros_acos (
    id integer NOT NULL,
    aro_id integer NOT NULL,
    aco_id integer NOT NULL,
    _create character varying(2) DEFAULT '0'::character varying NOT NULL,
    _read character varying(2) DEFAULT '0'::character varying NOT NULL,
    _update character varying(2) DEFAULT '0'::character varying NOT NULL,
    _delete character varying(2) DEFAULT '0'::character varying NOT NULL
);


--
-- TOC entry 1500 (class 1259 OID 16464)
-- Dependencies: 3
-- Name: branches; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE branches (
    id integer NOT NULL,
    branch_code character varying(5) NOT NULL,
    description character varying(50) NOT NULL
);


--
-- TOC entry 1502 (class 1259 OID 16472)
-- Dependencies: 3
-- Name: divisions; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE divisions (
    id integer NOT NULL,
    division_code character varying(5) NOT NULL,
    description character varying(50)
);


--
-- TOC entry 1498 (class 1259 OID 16453)
-- Dependencies: 3
-- Name: employees; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE employees (
    id integer NOT NULL,
    employee_id character varying(5) NOT NULL,
    full_name character varying(200) NOT NULL,
    name_with_initials character varying(50) NOT NULL,
    date_of_birth date,
    gender character(1),
    national_id character varying(20),
    address character varying(300),
    contact_number character varying(20),
    branch_id integer,
    division_id integer
);


--
-- TOC entry 1487 (class 1259 OID 16386)
-- Dependencies: 3
-- Name: system_menus; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE system_menus (
    id integer NOT NULL,
    parent_id smallint,
    title character varying(25),
    description character varying(50),
    program_name character varying(50),
    "order" smallint
);


--
-- TOC entry 1496 (class 1259 OID 16435)
-- Dependencies: 3
-- Name: users; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE users (
    id bigint NOT NULL,
    username character varying(50),
    password character varying(50)
);


--
-- TOC entry 1489 (class 1259 OID 16394)
-- Dependencies: 3 1490
-- Name: acos_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE acos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 1815 (class 0 OID 0)
-- Dependencies: 1489
-- Name: acos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE acos_id_seq OWNED BY acos.id;


--
-- TOC entry 1816 (class 0 OID 0)
-- Dependencies: 1489
-- Name: acos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('acos_id_seq', 1, false);


--
-- TOC entry 1493 (class 1259 OID 16420)
-- Dependencies: 1494 3
-- Name: aros_acos_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE aros_acos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 1817 (class 0 OID 0)
-- Dependencies: 1493
-- Name: aros_acos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE aros_acos_id_seq OWNED BY aros_acos.id;


--
-- TOC entry 1818 (class 0 OID 0)
-- Dependencies: 1493
-- Name: aros_acos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('aros_acos_id_seq', 1, false);


--
-- TOC entry 1491 (class 1259 OID 16407)
-- Dependencies: 1492 3
-- Name: aros_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE aros_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 1819 (class 0 OID 0)
-- Dependencies: 1491
-- Name: aros_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE aros_id_seq OWNED BY aros.id;


--
-- TOC entry 1820 (class 0 OID 0)
-- Dependencies: 1491
-- Name: aros_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('aros_id_seq', 1, false);


--
-- TOC entry 1499 (class 1259 OID 16462)
-- Dependencies: 3 1500
-- Name: branches_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE branches_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 1821 (class 0 OID 0)
-- Dependencies: 1499
-- Name: branches_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE branches_id_seq OWNED BY branches.id;


--
-- TOC entry 1822 (class 0 OID 0)
-- Dependencies: 1499
-- Name: branches_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('branches_id_seq', 2, true);


--
-- TOC entry 1501 (class 1259 OID 16470)
-- Dependencies: 3 1502
-- Name: divisions_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE divisions_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 1823 (class 0 OID 0)
-- Dependencies: 1501
-- Name: divisions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE divisions_id_seq OWNED BY divisions.id;


--
-- TOC entry 1824 (class 0 OID 0)
-- Dependencies: 1501
-- Name: divisions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('divisions_id_seq', 2, true);


--
-- TOC entry 1497 (class 1259 OID 16451)
-- Dependencies: 1498 3
-- Name: employees_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE employees_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 1825 (class 0 OID 0)
-- Dependencies: 1497
-- Name: employees_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE employees_id_seq OWNED BY employees.id;


--
-- TOC entry 1826 (class 0 OID 0)
-- Dependencies: 1497
-- Name: employees_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('employees_id_seq', 7, true);


--
-- TOC entry 1488 (class 1259 OID 16389)
-- Dependencies: 1487 3
-- Name: system_menu_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE system_menu_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 1827 (class 0 OID 0)
-- Dependencies: 1488
-- Name: system_menu_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE system_menu_id_seq OWNED BY system_menus.id;


--
-- TOC entry 1828 (class 0 OID 0)
-- Dependencies: 1488
-- Name: system_menu_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('system_menu_id_seq', 19, true);


--
-- TOC entry 1495 (class 1259 OID 16433)
-- Dependencies: 3 1496
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE users_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 1829 (class 0 OID 0)
-- Dependencies: 1495
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE users_id_seq OWNED BY users.id;


--
-- TOC entry 1830 (class 0 OID 0)
-- Dependencies: 1495
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('users_id_seq', 1, true);


--
-- TOC entry 1770 (class 2604 OID 16399)
-- Dependencies: 1490 1489 1490
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE acos ALTER COLUMN id SET DEFAULT nextval('acos_id_seq'::regclass);


--
-- TOC entry 1773 (class 2604 OID 16412)
-- Dependencies: 1491 1492 1492
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE aros ALTER COLUMN id SET DEFAULT nextval('aros_id_seq'::regclass);


--
-- TOC entry 1776 (class 2604 OID 16425)
-- Dependencies: 1494 1493 1494
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE aros_acos ALTER COLUMN id SET DEFAULT nextval('aros_acos_id_seq'::regclass);


--
-- TOC entry 1783 (class 2604 OID 16467)
-- Dependencies: 1500 1499 1500
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE branches ALTER COLUMN id SET DEFAULT nextval('branches_id_seq'::regclass);


--
-- TOC entry 1784 (class 2604 OID 16475)
-- Dependencies: 1502 1501 1502
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE divisions ALTER COLUMN id SET DEFAULT nextval('divisions_id_seq'::regclass);


--
-- TOC entry 1782 (class 2604 OID 16456)
-- Dependencies: 1498 1497 1498
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE employees ALTER COLUMN id SET DEFAULT nextval('employees_id_seq'::regclass);


--
-- TOC entry 1769 (class 2604 OID 16391)
-- Dependencies: 1488 1487
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE system_menus ALTER COLUMN id SET DEFAULT nextval('system_menu_id_seq'::regclass);


--
-- TOC entry 1781 (class 2604 OID 16438)
-- Dependencies: 1496 1495 1496
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE users ALTER COLUMN id SET DEFAULT nextval('users_id_seq'::regclass);


--
-- TOC entry 1803 (class 0 OID 16396)
-- Dependencies: 1490
-- Data for Name: acos; Type: TABLE DATA; Schema: public; Owner: -
--

COPY acos (id, parent_id, model, foreign_key, alias, lft, rght) FROM stdin;
\.


--
-- TOC entry 1804 (class 0 OID 16409)
-- Dependencies: 1492
-- Data for Name: aros; Type: TABLE DATA; Schema: public; Owner: -
--

COPY aros (id, parent_id, model, foreign_key, alias, lft, rght) FROM stdin;
\.


--
-- TOC entry 1805 (class 0 OID 16422)
-- Dependencies: 1494
-- Data for Name: aros_acos; Type: TABLE DATA; Schema: public; Owner: -
--

COPY aros_acos (id, aro_id, aco_id, _create, _read, _update, _delete) FROM stdin;
\.


--
-- TOC entry 1808 (class 0 OID 16464)
-- Dependencies: 1500
-- Data for Name: branches; Type: TABLE DATA; Schema: public; Owner: -
--

COPY branches (id, branch_code, description) FROM stdin;
1	STG	St. George, Utah
2	CMB	Colombo
\.


--
-- TOC entry 1809 (class 0 OID 16472)
-- Dependencies: 1502
-- Data for Name: divisions; Type: TABLE DATA; Schema: public; Owner: -
--

COPY divisions (id, division_code, description) FROM stdin;
1	MGT	Management
2	WEB	Web development
\.


--
-- TOC entry 1807 (class 0 OID 16453)
-- Dependencies: 1498
-- Data for Name: employees; Type: TABLE DATA; Schema: public; Owner: -
--

COPY employees (id, employee_id, full_name, name_with_initials, date_of_birth, gender, national_id, address, contact_number, branch_id, division_id) FROM stdin;
1	00001	Chaminda Keerthi Bandara	MMCK Bandara	1981-04-11	M	811021938V	113/4, Kithulawila Uyana, Kiriwattuduwa	94716833516	2	2
2	00002	Nuwan Chaturanga	MN Chaturanga	1981-05-23	M	811021938V	\N	94716833516	2	2
3	00003	James Cluff	J Cluff	1955-03-30	M	811021938V	\N	94716833516	1	1
4	00004	Darshika Weerasinghe	DD Weerasinghe	1980-08-21	F	811021938V	\N	94716833516	2	2
5	00005	Dihan Praneeth	D Praneeth	1965-09-12	M	811021938V	\N	94716833516	1	1
6	00006	Nishan Pradeep	N Pradeep	1974-08-15	M	811021938V	\N	94716833516	2	1
7	00007	Nishchala Kodithuwakku	N Kodithuwakku	1983-05-13	F	811021938V	\N	94716833516	2	2
\.


--
-- TOC entry 1802 (class 0 OID 16386)
-- Dependencies: 1487
-- Data for Name: system_menus; Type: TABLE DATA; Schema: public; Owner: -
--

COPY system_menus (id, parent_id, title, description, program_name, "order") FROM stdin;
1	0	Planning	Planning	\N	1
2	0	Execution	Execution	\N	2
3	0	Monitoring	Monitoring	\N	3
4	0	Controlling	Controlling	\N	4
5	1	Employees	Employees	/planning/employees	1
6	1	Org. Setup	Org. Setup	/planning/organization_setup	2
7	1	Asset Categories	Asset Categories	/planning/asset_categories	3
8	1	Asset Suppliers	Asset Suppliers	/planning/asset_suppliers	4
9	2	Asset Registry	Asset Registry	/execution/asset_registry	1
10	2	Asset Allocation	Asset Allocation	/execution/asset_allocation	2
11	2	Asset Complaints	Asset Complaints	/execution/asset_complaints	3
12	2	Asset Requests	Asset Requests	/execution/asset_requests	4
13	3	Asset Browser	Asset Browser	/monitoring/asset_browser	1
14	3	Transaction Reports	Transaction Reports	/monitoring/transaction_reports	2
15	3	Complaints	Complaints	/monitoring/complaints	3
16	3	Requests	Requests	/monitoring/requests	4
17	4	Change Custodian	Change Custodian	/controlling/change_custodian	1
18	4	Change Location	Change Location	/controlling/change_location	2
19	4	Disposals	Disposals	/controlling/disposals	3
\.


--
-- TOC entry 1806 (class 0 OID 16435)
-- Dependencies: 1496
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: -
--

COPY users (id, username, password) FROM stdin;
1	keerthi	827e7af732bc0e052f44ce9112483af641774b69
\.


--
-- TOC entry 1788 (class 2606 OID 16406)
-- Dependencies: 1490 1490
-- Name: acos_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY acos
    ADD CONSTRAINT acos_pkey PRIMARY KEY (id);


--
-- TOC entry 1793 (class 2606 OID 16431)
-- Dependencies: 1494 1494
-- Name: aros_acos_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY aros_acos
    ADD CONSTRAINT aros_acos_pkey PRIMARY KEY (id);


--
-- TOC entry 1790 (class 2606 OID 16419)
-- Dependencies: 1492 1492
-- Name: aros_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY aros
    ADD CONSTRAINT aros_pkey PRIMARY KEY (id);


--
-- TOC entry 1799 (class 2606 OID 16469)
-- Dependencies: 1500 1500
-- Name: branches_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY branches
    ADD CONSTRAINT branches_pkey PRIMARY KEY (id);


--
-- TOC entry 1801 (class 2606 OID 16477)
-- Dependencies: 1502 1502
-- Name: divisions_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY divisions
    ADD CONSTRAINT divisions_pkey PRIMARY KEY (id);


--
-- TOC entry 1797 (class 2606 OID 16458)
-- Dependencies: 1498 1498
-- Name: employees_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY employees
    ADD CONSTRAINT employees_pkey PRIMARY KEY (id);


--
-- TOC entry 1786 (class 2606 OID 16393)
-- Dependencies: 1487 1487
-- Name: system_menu_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY system_menus
    ADD CONSTRAINT system_menu_pkey PRIMARY KEY (id);


--
-- TOC entry 1795 (class 2606 OID 16440)
-- Dependencies: 1496 1496
-- Name: users_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- TOC entry 1791 (class 1259 OID 16432)
-- Dependencies: 1494 1494
-- Name: aro_aco_key; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE UNIQUE INDEX aro_aco_key ON aros_acos USING btree (aro_id, aco_id);


--
-- TOC entry 1814 (class 0 OID 0)
-- Dependencies: 3
-- Name: public; Type: ACL; Schema: -; Owner: -
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2009-07-06 22:14:05 IST

--
-- PostgreSQL database dump complete
--


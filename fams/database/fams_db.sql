--
-- PostgreSQL database dump
--

SET client_encoding = 'UTF8';
SET standard_conforming_strings = off;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;

SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: acos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
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


ALTER TABLE public.acos OWNER TO postgres;

--
-- Name: acos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE acos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.acos_id_seq OWNER TO postgres;

--
-- Name: acos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE acos_id_seq OWNED BY acos.id;


--
-- Name: acos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('acos_id_seq', 1, false);


--
-- Name: aros; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
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


ALTER TABLE public.aros OWNER TO postgres;

--
-- Name: aros_acos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
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


ALTER TABLE public.aros_acos OWNER TO postgres;

--
-- Name: aros_acos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE aros_acos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.aros_acos_id_seq OWNER TO postgres;

--
-- Name: aros_acos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE aros_acos_id_seq OWNED BY aros_acos.id;


--
-- Name: aros_acos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('aros_acos_id_seq', 1, false);


--
-- Name: aros_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE aros_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.aros_id_seq OWNER TO postgres;

--
-- Name: aros_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE aros_id_seq OWNED BY aros.id;


--
-- Name: aros_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('aros_id_seq', 1, false);


--
-- Name: branches; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE branches (
    id integer NOT NULL,
    branch_code character varying(5) NOT NULL,
    description character varying(50) NOT NULL
);


ALTER TABLE public.branches OWNER TO postgres;

--
-- Name: branches_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE branches_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.branches_id_seq OWNER TO postgres;

--
-- Name: branches_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE branches_id_seq OWNED BY branches.id;


--
-- Name: branches_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('branches_id_seq', 2, true);


--
-- Name: divisions; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE divisions (
    id integer NOT NULL,
    division_code character varying(5) NOT NULL,
    description character varying(50)
);


ALTER TABLE public.divisions OWNER TO postgres;

--
-- Name: divisions_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE divisions_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.divisions_id_seq OWNER TO postgres;

--
-- Name: divisions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE divisions_id_seq OWNED BY divisions.id;


--
-- Name: divisions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('divisions_id_seq', 2, true);


--
-- Name: employees; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE employees (
    id integer NOT NULL,
    employee_id character varying(5) NOT NULL,
    full_name character varying(200) NOT NULL,
    name_with_initials character varying(50) NOT NULL,
    date_of_birth date,
    gender character(1),
    email character varying(50),
    address character varying(300),
    contact_number character varying(20),
    branch_id integer,
    division_id integer,
    photo character varying(50),
    record_status character(1)
);


ALTER TABLE public.employees OWNER TO postgres;

--
-- Name: employees_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE employees_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.employees_id_seq OWNER TO postgres;

--
-- Name: employees_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE employees_id_seq OWNED BY employees.id;


--
-- Name: employees_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('employees_id_seq', 15, true);


--
-- Name: system_menus; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE system_menus (
    id integer NOT NULL,
    parent_id smallint,
    title character varying(25),
    description character varying(50),
    program_name character varying(50),
    "order" smallint
);


ALTER TABLE public.system_menus OWNER TO postgres;

--
-- Name: system_menu_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE system_menu_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.system_menu_id_seq OWNER TO postgres;

--
-- Name: system_menu_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE system_menu_id_seq OWNED BY system_menus.id;


--
-- Name: system_menu_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('system_menu_id_seq', 19, true);


--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE users (
    id bigint NOT NULL,
    username character varying(50),
    password character varying(50)
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE users_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE users_id_seq OWNED BY users.id;


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('users_id_seq', 1, true);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE acos ALTER COLUMN id SET DEFAULT nextval('acos_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE aros ALTER COLUMN id SET DEFAULT nextval('aros_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE aros_acos ALTER COLUMN id SET DEFAULT nextval('aros_acos_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE branches ALTER COLUMN id SET DEFAULT nextval('branches_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE divisions ALTER COLUMN id SET DEFAULT nextval('divisions_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE employees ALTER COLUMN id SET DEFAULT nextval('employees_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE system_menus ALTER COLUMN id SET DEFAULT nextval('system_menu_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE users ALTER COLUMN id SET DEFAULT nextval('users_id_seq'::regclass);


--
-- Data for Name: acos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY acos (id, parent_id, model, foreign_key, alias, lft, rght) FROM stdin;
\.


--
-- Data for Name: aros; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY aros (id, parent_id, model, foreign_key, alias, lft, rght) FROM stdin;
\.


--
-- Data for Name: aros_acos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY aros_acos (id, aro_id, aco_id, _create, _read, _update, _delete) FROM stdin;
\.


--
-- Data for Name: branches; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY branches (id, branch_code, description) FROM stdin;
1	STG	St. George, Utah
2	CMB	Colombo
\.


--
-- Data for Name: divisions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY divisions (id, division_code, description) FROM stdin;
1	MGT	Management
2	WEB	Web development
\.


--
-- Data for Name: employees; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY employees (id, employee_id, full_name, name_with_initials, date_of_birth, gender, email, address, contact_number, branch_id, division_id, photo, record_status) FROM stdin;
14	00014	Mohomad Huzzain	M Huzzain	1985-02-04	M	mohomad.huzzain@laknipayum.com	Main Street, Colombo 08	0781234567	2	2		D
4	00004	Darshika Weerasinghe	DD Weerasinghe	1980-08-21	F	keerthi.bandara@laknipayum.com	\N	94716833516	2	2	\N	A
10	00008	Abigail Cluff	A Cluff	1991-07-19	F	keerthi.bandara@laknipayum.com	Main Street, St George, Utah USA	0123456789	\N	\N	\N	D
9	00008	Abigail Cluff	A Cluff	1991-07-19	F	keerthi.bandara@laknipayum.com	Main Street, St George, Utah USA	0123456789	\N	\N	\N	D
8	00008	Dewian Cluff	D Cluff	1965-03-19	M	keerthi.bandara@laknipayum.com	Main Street, St George, Utah USA	0123456789	\N	\N	\N	D
1	00001	Chaminda Keerthi Bandara	MMCK Bandara	1981-04-11	M	keerthi.bandara@laknipayum.com	113/4, Kithulawila Uyana, Kiriwattuduwa	0716833516	2	2	c4ca4238a0b923820dcc509a6f75849b.gif	A
2	00002	Nuwan Chaturanga	MN Chaturanga	1981-05-23	M	nuwan.chaturanga@laknipayum.com	Pitipana, Balangoda.	94714567567	2	2	c81e728d9d4c2f636f067f89cc14862c.jpg	A
13	00013	Asanka Indika	A Indika	1975-08-04	M	asanka.indika@laknipayum.com	Galle Road, Ambalangoda	0721234567	2	2	\N	D
12	00011	Mali Duruge	M Duruge	2009-07-08	F	keerthi.bandara@laknipayum.com	Thalahena North,	7101223123	2	2		D
11	00010	Abigail Cluff	A Cluff	1991-07-19	F	keerthi.bandara@laknipayum.com	Main Street, St George, Utah USA	0123456789	1	1	\N	D
6	00006	Nishan Pradeep	N Pradeep	1974-08-15	M	keerthi.bandara@laknipayum.com	Battaramulla	94716833516	2	1	1679091c5a880faf6fb5e6087eb1b2dc-4.jpg	A
16	00015	James Banda	J Banda	2009-08-26	M	banda@laknipayum.com	Battaramulla	01023456789	2	2		A
5	00005	Dihan Praneeth	D Praneeth	1965-09-12	M	keerthi.bandara@laknipayum.com	Minasota	94716833516	1	1		A
18	00017	Malkanthi Perera	M Perera	2009-08-19	F	m.perera@yahoo.com	Katharagama	6547891230	2	2		A
19	00018	Marasi Paala	M Paala	2009-08-03	M	marasi.paala@gmail.com	Maradaana	6935824710	2	2		A
17	00016	Somawathi Peiris	S Peiris	2009-08-05	M	s.peiris@laknipayum.com	Galle	9876543210	1	1		A
3	00003	James Cluff	J Cluff	1955-03-30	M	james.cluff@laknipayum.com	St. George, Utah, USA	01716833516	1	1		A
7	00007	Nishchala Kodithuwakku	N Kodithuwakku	1983-05-13	F	keerthi.bandara@laknipayum.com	\N	94716833516	2	2	8f14e45fceea167a5a36dedd4bea2543.jpg	D
\.


--
-- Data for Name: system_menus; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY system_menus (id, parent_id, title, description, program_name, "order") FROM stdin;
1	0	Planning	Planning	\N	1
2	0	Execution	Execution	\N	2
3	0	Monitoring	Monitoring	\N	3
4	0	Controlling	Controlling	\N	4
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
5	1	Employees	Employees	/employees/employees	1
20	4	Disposals	Disposals	/controlling/disposals	3
19	4	Change Location	Change Location	/controlling/change_location	2
18	4	Change Custodian	Change Custodian	/controlling/change_custodian	1
17	3	Depreciation Info	Depreciation Info	/monitoring/depreciation_info	5
6	1	Org. Setup	Org. Setup	/org_setup/org_structure	2
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY users (id, username, password) FROM stdin;
1	keerthi	827e7af732bc0e052f44ce9112483af641774b69
\.


--
-- Name: acos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY acos
    ADD CONSTRAINT acos_pkey PRIMARY KEY (id);


--
-- Name: aros_acos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY aros_acos
    ADD CONSTRAINT aros_acos_pkey PRIMARY KEY (id);


--
-- Name: aros_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY aros
    ADD CONSTRAINT aros_pkey PRIMARY KEY (id);


--
-- Name: branches_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY branches
    ADD CONSTRAINT branches_pkey PRIMARY KEY (id);


--
-- Name: divisions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY divisions
    ADD CONSTRAINT divisions_pkey PRIMARY KEY (id);


--
-- Name: employees_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY employees
    ADD CONSTRAINT employees_pkey PRIMARY KEY (id);


--
-- Name: system_menu_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY system_menus
    ADD CONSTRAINT system_menu_pkey PRIMARY KEY (id);


--
-- Name: users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: aro_aco_key; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX aro_aco_key ON aros_acos USING btree (aro_id, aco_id);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--


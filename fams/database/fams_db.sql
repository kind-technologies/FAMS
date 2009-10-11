--
-- PostgreSQL database dump
--

-- Started on 2009-10-11 23:10:20 IST

SET client_encoding = 'UTF8';
SET standard_conforming_strings = off;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;

SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 1506 (class 1259 OID 17451)
-- Dependencies: 1800 1801 6
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
-- TOC entry 1508 (class 1259 OID 17461)
-- Dependencies: 1803 1804 6
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
-- TOC entry 1509 (class 1259 OID 17469)
-- Dependencies: 1806 1807 1808 1809 6
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
-- TOC entry 1523 (class 1259 OID 18399)
-- Dependencies: 6
-- Name: asset_categories; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE asset_categories (
    id integer NOT NULL,
    category_code character varying(5),
    name character varying(20),
    description character varying(150)
);


--
-- TOC entry 1531 (class 1259 OID 18439)
-- Dependencies: 6
-- Name: asset_complaints; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE asset_complaints (
    id integer NOT NULL
);


--
-- TOC entry 1533 (class 1259 OID 18447)
-- Dependencies: 6
-- Name: asset_requests; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE asset_requests (
    id integer NOT NULL
);


--
-- TOC entry 1529 (class 1259 OID 18423)
-- Dependencies: 6
-- Name: assets; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE assets (
    id bigint NOT NULL,
    asset_code character varying(10),
    short_name character varying(100),
    description character varying(200),
    supplier_id integer,
    purchase_price numeric,
    purchase_date date,
    lifespan integer,
    salvage_value numeric
);


--
-- TOC entry 1512 (class 1259 OID 17480)
-- Dependencies: 6
-- Name: branches; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE branches (
    id integer NOT NULL,
    branch_code character varying(5) NOT NULL,
    description character varying(50) NOT NULL
);


--
-- TOC entry 1514 (class 1259 OID 17485)
-- Dependencies: 6
-- Name: divisions; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE divisions (
    id integer NOT NULL,
    division_code character varying(5) NOT NULL,
    description character varying(50)
);


--
-- TOC entry 1516 (class 1259 OID 17490)
-- Dependencies: 1814 6
-- Name: employees; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE employees (
    id integer NOT NULL,
    employee_id character varying(5) NOT NULL,
    full_name character varying(200) NOT NULL,
    name_with_initials character varying(50) NOT NULL,
    date_of_birth date DEFAULT now(),
    gender character(1),
    email character varying(50),
    address character varying(300),
    contact_number character varying(20),
    branch_id integer,
    division_id integer,
    photo character varying(50),
    record_status character(1)
);


--
-- TOC entry 1527 (class 1259 OID 18415)
-- Dependencies: 6
-- Name: locations; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE locations (
    id integer NOT NULL,
    location_code character varying(5),
    description character varying(150),
    branch_id integer
);


--
-- TOC entry 1525 (class 1259 OID 18407)
-- Dependencies: 6
-- Name: suppliers; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE suppliers (
    id integer NOT NULL,
    supplier_code character varying(5),
    description character varying(150),
    address character varying(200),
    contact_number character varying(20),
    email character varying(50)
);


--
-- TOC entry 1518 (class 1259 OID 17498)
-- Dependencies: 6
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
-- TOC entry 1520 (class 1259 OID 17503)
-- Dependencies: 6
-- Name: users; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE users (
    id bigint NOT NULL,
    username character varying(50),
    password character varying(50)
);


--
-- TOC entry 1507 (class 1259 OID 17459)
-- Dependencies: 6 1506
-- Name: acos_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE acos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 1871 (class 0 OID 0)
-- Dependencies: 1507
-- Name: acos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE acos_id_seq OWNED BY acos.id;


--
-- TOC entry 1872 (class 0 OID 0)
-- Dependencies: 1507
-- Name: acos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('acos_id_seq', 1, false);


--
-- TOC entry 1510 (class 1259 OID 17476)
-- Dependencies: 1509 6
-- Name: aros_acos_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE aros_acos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 1873 (class 0 OID 0)
-- Dependencies: 1510
-- Name: aros_acos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE aros_acos_id_seq OWNED BY aros_acos.id;


--
-- TOC entry 1874 (class 0 OID 0)
-- Dependencies: 1510
-- Name: aros_acos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('aros_acos_id_seq', 1, false);


--
-- TOC entry 1511 (class 1259 OID 17478)
-- Dependencies: 6 1508
-- Name: aros_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE aros_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 1875 (class 0 OID 0)
-- Dependencies: 1511
-- Name: aros_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE aros_id_seq OWNED BY aros.id;


--
-- TOC entry 1876 (class 0 OID 0)
-- Dependencies: 1511
-- Name: aros_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('aros_id_seq', 1, false);


--
-- TOC entry 1522 (class 1259 OID 18397)
-- Dependencies: 1523 6
-- Name: asset_categories_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE asset_categories_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 1877 (class 0 OID 0)
-- Dependencies: 1522
-- Name: asset_categories_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE asset_categories_id_seq OWNED BY asset_categories.id;


--
-- TOC entry 1878 (class 0 OID 0)
-- Dependencies: 1522
-- Name: asset_categories_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('asset_categories_id_seq', 1, false);


--
-- TOC entry 1530 (class 1259 OID 18437)
-- Dependencies: 1531 6
-- Name: asset_complaints_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE asset_complaints_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 1879 (class 0 OID 0)
-- Dependencies: 1530
-- Name: asset_complaints_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE asset_complaints_id_seq OWNED BY asset_complaints.id;


--
-- TOC entry 1880 (class 0 OID 0)
-- Dependencies: 1530
-- Name: asset_complaints_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('asset_complaints_id_seq', 1, false);


--
-- TOC entry 1532 (class 1259 OID 18445)
-- Dependencies: 6 1533
-- Name: asset_requests_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE asset_requests_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 1881 (class 0 OID 0)
-- Dependencies: 1532
-- Name: asset_requests_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE asset_requests_id_seq OWNED BY asset_requests.id;


--
-- TOC entry 1882 (class 0 OID 0)
-- Dependencies: 1532
-- Name: asset_requests_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('asset_requests_id_seq', 1, false);


--
-- TOC entry 1528 (class 1259 OID 18421)
-- Dependencies: 1529 6
-- Name: assets_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE assets_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 1883 (class 0 OID 0)
-- Dependencies: 1528
-- Name: assets_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE assets_id_seq OWNED BY assets.id;


--
-- TOC entry 1884 (class 0 OID 0)
-- Dependencies: 1528
-- Name: assets_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('assets_id_seq', 1, false);


--
-- TOC entry 1513 (class 1259 OID 17483)
-- Dependencies: 1512 6
-- Name: branches_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE branches_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 1885 (class 0 OID 0)
-- Dependencies: 1513
-- Name: branches_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE branches_id_seq OWNED BY branches.id;


--
-- TOC entry 1886 (class 0 OID 0)
-- Dependencies: 1513
-- Name: branches_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('branches_id_seq', 2, true);


--
-- TOC entry 1515 (class 1259 OID 17488)
-- Dependencies: 1514 6
-- Name: divisions_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE divisions_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 1887 (class 0 OID 0)
-- Dependencies: 1515
-- Name: divisions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE divisions_id_seq OWNED BY divisions.id;


--
-- TOC entry 1888 (class 0 OID 0)
-- Dependencies: 1515
-- Name: divisions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('divisions_id_seq', 2, true);


--
-- TOC entry 1517 (class 1259 OID 17496)
-- Dependencies: 1516 6
-- Name: employees_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE employees_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 1889 (class 0 OID 0)
-- Dependencies: 1517
-- Name: employees_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE employees_id_seq OWNED BY employees.id;


--
-- TOC entry 1890 (class 0 OID 0)
-- Dependencies: 1517
-- Name: employees_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('employees_id_seq', 15, true);


--
-- TOC entry 1526 (class 1259 OID 18413)
-- Dependencies: 6 1527
-- Name: locations_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE locations_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 1891 (class 0 OID 0)
-- Dependencies: 1526
-- Name: locations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE locations_id_seq OWNED BY locations.id;


--
-- TOC entry 1892 (class 0 OID 0)
-- Dependencies: 1526
-- Name: locations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('locations_id_seq', 1, true);


--
-- TOC entry 1524 (class 1259 OID 18405)
-- Dependencies: 6 1525
-- Name: suppliers_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE suppliers_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 1893 (class 0 OID 0)
-- Dependencies: 1524
-- Name: suppliers_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE suppliers_id_seq OWNED BY suppliers.id;


--
-- TOC entry 1894 (class 0 OID 0)
-- Dependencies: 1524
-- Name: suppliers_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('suppliers_id_seq', 1, false);


--
-- TOC entry 1519 (class 1259 OID 17501)
-- Dependencies: 6 1518
-- Name: system_menu_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE system_menu_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 1895 (class 0 OID 0)
-- Dependencies: 1519
-- Name: system_menu_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE system_menu_id_seq OWNED BY system_menus.id;


--
-- TOC entry 1896 (class 0 OID 0)
-- Dependencies: 1519
-- Name: system_menu_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('system_menu_id_seq', 19, true);


--
-- TOC entry 1521 (class 1259 OID 17506)
-- Dependencies: 1520 6
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE users_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


--
-- TOC entry 1897 (class 0 OID 0)
-- Dependencies: 1521
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE users_id_seq OWNED BY users.id;


--
-- TOC entry 1898 (class 0 OID 0)
-- Dependencies: 1521
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('users_id_seq', 1, true);


--
-- TOC entry 1802 (class 2604 OID 17508)
-- Dependencies: 1507 1506
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE acos ALTER COLUMN id SET DEFAULT nextval('acos_id_seq'::regclass);


--
-- TOC entry 1805 (class 2604 OID 17509)
-- Dependencies: 1511 1508
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE aros ALTER COLUMN id SET DEFAULT nextval('aros_id_seq'::regclass);


--
-- TOC entry 1810 (class 2604 OID 17510)
-- Dependencies: 1510 1509
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE aros_acos ALTER COLUMN id SET DEFAULT nextval('aros_acos_id_seq'::regclass);


--
-- TOC entry 1817 (class 2604 OID 18402)
-- Dependencies: 1522 1523 1523
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE asset_categories ALTER COLUMN id SET DEFAULT nextval('asset_categories_id_seq'::regclass);


--
-- TOC entry 1821 (class 2604 OID 18442)
-- Dependencies: 1531 1530 1531
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE asset_complaints ALTER COLUMN id SET DEFAULT nextval('asset_complaints_id_seq'::regclass);


--
-- TOC entry 1822 (class 2604 OID 18450)
-- Dependencies: 1533 1532 1533
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE asset_requests ALTER COLUMN id SET DEFAULT nextval('asset_requests_id_seq'::regclass);


--
-- TOC entry 1820 (class 2604 OID 18426)
-- Dependencies: 1528 1529 1529
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE assets ALTER COLUMN id SET DEFAULT nextval('assets_id_seq'::regclass);


--
-- TOC entry 1811 (class 2604 OID 17511)
-- Dependencies: 1513 1512
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE branches ALTER COLUMN id SET DEFAULT nextval('branches_id_seq'::regclass);


--
-- TOC entry 1812 (class 2604 OID 17512)
-- Dependencies: 1515 1514
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE divisions ALTER COLUMN id SET DEFAULT nextval('divisions_id_seq'::regclass);


--
-- TOC entry 1813 (class 2604 OID 17513)
-- Dependencies: 1517 1516
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE employees ALTER COLUMN id SET DEFAULT nextval('employees_id_seq'::regclass);


--
-- TOC entry 1819 (class 2604 OID 18418)
-- Dependencies: 1527 1526 1527
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE locations ALTER COLUMN id SET DEFAULT nextval('locations_id_seq'::regclass);


--
-- TOC entry 1818 (class 2604 OID 18410)
-- Dependencies: 1525 1524 1525
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE suppliers ALTER COLUMN id SET DEFAULT nextval('suppliers_id_seq'::regclass);


--
-- TOC entry 1815 (class 2604 OID 17514)
-- Dependencies: 1519 1518
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE system_menus ALTER COLUMN id SET DEFAULT nextval('system_menu_id_seq'::regclass);


--
-- TOC entry 1816 (class 2604 OID 17515)
-- Dependencies: 1521 1520
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE users ALTER COLUMN id SET DEFAULT nextval('users_id_seq'::regclass);


--
-- TOC entry 1852 (class 0 OID 17451)
-- Dependencies: 1506
-- Data for Name: acos; Type: TABLE DATA; Schema: public; Owner: -
--

COPY acos (id, parent_id, model, foreign_key, alias, lft, rght) FROM stdin;
\.


--
-- TOC entry 1853 (class 0 OID 17461)
-- Dependencies: 1508
-- Data for Name: aros; Type: TABLE DATA; Schema: public; Owner: -
--

COPY aros (id, parent_id, model, foreign_key, alias, lft, rght) FROM stdin;
\.


--
-- TOC entry 1854 (class 0 OID 17469)
-- Dependencies: 1509
-- Data for Name: aros_acos; Type: TABLE DATA; Schema: public; Owner: -
--

COPY aros_acos (id, aro_id, aco_id, _create, _read, _update, _delete) FROM stdin;
\.


--
-- TOC entry 1860 (class 0 OID 18399)
-- Dependencies: 1523
-- Data for Name: asset_categories; Type: TABLE DATA; Schema: public; Owner: -
--

COPY asset_categories (id, category_code, name, description) FROM stdin;
\.


--
-- TOC entry 1864 (class 0 OID 18439)
-- Dependencies: 1531
-- Data for Name: asset_complaints; Type: TABLE DATA; Schema: public; Owner: -
--

COPY asset_complaints (id) FROM stdin;
\.


--
-- TOC entry 1865 (class 0 OID 18447)
-- Dependencies: 1533
-- Data for Name: asset_requests; Type: TABLE DATA; Schema: public; Owner: -
--

COPY asset_requests (id) FROM stdin;
\.


--
-- TOC entry 1863 (class 0 OID 18423)
-- Dependencies: 1529
-- Data for Name: assets; Type: TABLE DATA; Schema: public; Owner: -
--

COPY assets (id, asset_code, short_name, description, supplier_id, purchase_price, purchase_date, lifespan, salvage_value) FROM stdin;
\.


--
-- TOC entry 1855 (class 0 OID 17480)
-- Dependencies: 1512
-- Data for Name: branches; Type: TABLE DATA; Schema: public; Owner: -
--

COPY branches (id, branch_code, description) FROM stdin;
1	STG	St. George, Utah
2	CMB	Colombo
\.


--
-- TOC entry 1856 (class 0 OID 17485)
-- Dependencies: 1514
-- Data for Name: divisions; Type: TABLE DATA; Schema: public; Owner: -
--

COPY divisions (id, division_code, description) FROM stdin;
1	MGT	Management
2	WEB	Web development
\.


--
-- TOC entry 1857 (class 0 OID 17490)
-- Dependencies: 1516
-- Data for Name: employees; Type: TABLE DATA; Schema: public; Owner: -
--

COPY employees (id, employee_id, full_name, name_with_initials, date_of_birth, gender, email, address, contact_number, branch_id, division_id, photo, record_status) FROM stdin;
4	00004	Darshika Weerasinghe	DD Weerasinghe	1980-08-21	F	keerthi.bandara@laknipayum.com	\N	94716833516	2	2	\N	A
10	00008	Abigail Cluff	A Cluff	1991-07-19	F	keerthi.bandara@laknipayum.com	Main Street, St George, Utah USA	0123456789	\N	\N	\N	D
9	00008	Abigail Cluff	A Cluff	1991-07-19	F	keerthi.bandara@laknipayum.com	Main Street, St George, Utah USA	0123456789	\N	\N	\N	D
8	00008	Dewian Cluff	D Cluff	1965-03-19	M	keerthi.bandara@laknipayum.com	Main Street, St George, Utah USA	0123456789	\N	\N	\N	D
13	00013	Asanka Indika	A Indika	1975-08-04	M	asanka.indika@laknipayum.com	Galle Road, Ambalangoda	0721234567	2	2	\N	D
11	00010	Abigail Cluff	A Cluff	1991-07-19	F	keerthi.bandara@laknipayum.com	Main Street, St George, Utah USA	0123456789	1	1	\N	D
2	00002	Nuwan Chaturanga	MN Chaturanga	1981-05-23	M	nuwan.chaturanga@laknipayum.com	Pitipana, Balangoda.	94714567567	2	2	\N	A
6	00006	Nishan Pradeep	N Pradeep	1974-08-15	M	keerthi.bandara@laknipayum.com	Battaramulla	94716833516	2	1	\N	A
5	00005	Dihan Praneeth	D Praneeth	1965-09-12	M	keerthi.bandara@laknipayum.com	Minasota	94716833516	1	1	\N	A
7	00007	Nishchala Kodithuwakku	N Kodithuwakku	1983-05-13	F	keerthi.bandara@laknipayum.com	\N	94716833516	2	2	\N	D
3	00003	James Cluff	J Cluff	1955-03-30	M	james.cluff@laknipayum.com	St. George, Utah, USA	01716833516	1	1	\N	A
12	00011	Mali Duruge	M Duruge	2009-07-08	F	keerthi.bandara@laknipayum.com	Thalahena North,	7101223123	2	2	\N	D
14	00014	Mohomad Huzzain	M Huzzain	1985-02-04	M	mohomad.huzzain@laknipayum.com	Main Street, Colombo 08	0781234567	2	2	\N	D
16	00015	James Banda	J Banda	2009-08-26	M	banda@laknipayum.com	Battaramulla	01023456789	2	2	\N	A
17	00016	Somawathi Peiris	S Peiris	2009-08-05	M	s.peiris@laknipayum.com	Galle	9876543210	1	1	\N	A
1	00001	Chaminda Keerthi Bandara	MMCK Bandara	1981-04-11	M	keerthi.bandara@laknipayum.com	113/4, Kithulawila Uyana, Kiriwattuduwa	0716833516	2	2	c4ca4238a0b923820dcc509a6f75849b-4.png	A
19	00018	Marasi Paala	M Paala	2009-08-03	M	marasi.paala@gmail.com	Maradaana	6935824710	2	2		D
18	00017	Malkanthi Perera	M Perera	2009-08-19	F	m.perera@yahoo.com	Katharagama	6547891230	2	2		D
\.


--
-- TOC entry 1862 (class 0 OID 18415)
-- Dependencies: 1527
-- Data for Name: locations; Type: TABLE DATA; Schema: public; Owner: -
--

COPY locations (id, location_code, description, branch_id) FROM stdin;
1	OFCAR	Office Area	2
\.


--
-- TOC entry 1861 (class 0 OID 18407)
-- Dependencies: 1525
-- Data for Name: suppliers; Type: TABLE DATA; Schema: public; Owner: -
--

COPY suppliers (id, supplier_code, description, address, contact_number, email) FROM stdin;
\.


--
-- TOC entry 1858 (class 0 OID 17498)
-- Dependencies: 1518
-- Data for Name: system_menus; Type: TABLE DATA; Schema: public; Owner: -
--

COPY system_menus (id, parent_id, title, description, program_name, "order") FROM stdin;
1	0	Planning	Planning	\N	1
2	0	Execution	Execution	\N	2
3	0	Monitoring	Monitoring	\N	3
4	0	Controlling	Controlling	\N	4
5	1	Employees	Employees	/employees/employees	1
6	1	Org. Setup	Org. Setup	/org_setup/org_structure	2
7	1	Asset Categories	Asset Categories	/asset_categories/asset_categories	3
8	1	Asset Suppliers	Asset Suppliers	/suppliers/asset_suppliers	4
9	2	Asset Registry	Asset Registry	/assets/asset_registry	1
10	2	Asset Allocation	Asset Allocation	/assets/asset_allocation	2
11	2	Asset Complaints	Asset Complaints	/asset_complaints/asset_complaints	3
12	2	Asset Requests	Asset Requests	/asset_requests/asset_requests	4
15	3	Depreciation Info	Depreciation Info	/depreciation/depreciation_info	3
14	3	Depreciation Report	Depreciation Report	/depreciation/depreciation_report_yearly	2
13	3	Asset Browser	Asset Browser	/assets/assets_by_category	1
16	3	Requests	Requests	/asset_requests/view_requests	4
17	3	Complaints	Complaints	/asset_complaints/view_complaints	5
18	4	Change Custodian	Change Custodian	/assets/change_custodian	1
19	4	Change Location	Change Location	/assets/change_location	2
20	4	Disposals	Disposals	/assets/disposals	3
\.


--
-- TOC entry 1859 (class 0 OID 17503)
-- Dependencies: 1520
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: -
--

COPY users (id, username, password) FROM stdin;
1	keerthi	827e7af732bc0e052f44ce9112483af641774b69
\.


--
-- TOC entry 1824 (class 2606 OID 17517)
-- Dependencies: 1506 1506
-- Name: acos_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY acos
    ADD CONSTRAINT acos_pkey PRIMARY KEY (id);


--
-- TOC entry 1829 (class 2606 OID 17519)
-- Dependencies: 1509 1509
-- Name: aros_acos_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY aros_acos
    ADD CONSTRAINT aros_acos_pkey PRIMARY KEY (id);


--
-- TOC entry 1826 (class 2606 OID 17521)
-- Dependencies: 1508 1508
-- Name: aros_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY aros
    ADD CONSTRAINT aros_pkey PRIMARY KEY (id);


--
-- TOC entry 1841 (class 2606 OID 18404)
-- Dependencies: 1523 1523
-- Name: asset_categories_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY asset_categories
    ADD CONSTRAINT asset_categories_pkey PRIMARY KEY (id);


--
-- TOC entry 1849 (class 2606 OID 18444)
-- Dependencies: 1531 1531
-- Name: asset_complaints_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY asset_complaints
    ADD CONSTRAINT asset_complaints_pkey PRIMARY KEY (id);


--
-- TOC entry 1851 (class 2606 OID 18452)
-- Dependencies: 1533 1533
-- Name: asset_requests_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY asset_requests
    ADD CONSTRAINT asset_requests_pkey PRIMARY KEY (id);


--
-- TOC entry 1847 (class 2606 OID 18428)
-- Dependencies: 1529 1529
-- Name: assets_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY assets
    ADD CONSTRAINT assets_pkey PRIMARY KEY (id);


--
-- TOC entry 1831 (class 2606 OID 17523)
-- Dependencies: 1512 1512
-- Name: branches_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY branches
    ADD CONSTRAINT branches_pkey PRIMARY KEY (id);


--
-- TOC entry 1833 (class 2606 OID 17525)
-- Dependencies: 1514 1514
-- Name: divisions_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY divisions
    ADD CONSTRAINT divisions_pkey PRIMARY KEY (id);


--
-- TOC entry 1835 (class 2606 OID 17527)
-- Dependencies: 1516 1516
-- Name: employees_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY employees
    ADD CONSTRAINT employees_pkey PRIMARY KEY (id);


--
-- TOC entry 1845 (class 2606 OID 18420)
-- Dependencies: 1527 1527
-- Name: locations_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY locations
    ADD CONSTRAINT locations_pkey PRIMARY KEY (id);


--
-- TOC entry 1843 (class 2606 OID 18412)
-- Dependencies: 1525 1525
-- Name: suppliers_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY suppliers
    ADD CONSTRAINT suppliers_pkey PRIMARY KEY (id);


--
-- TOC entry 1837 (class 2606 OID 17529)
-- Dependencies: 1518 1518
-- Name: system_menu_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY system_menus
    ADD CONSTRAINT system_menu_pkey PRIMARY KEY (id);


--
-- TOC entry 1839 (class 2606 OID 17531)
-- Dependencies: 1520 1520
-- Name: users_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- TOC entry 1827 (class 1259 OID 17532)
-- Dependencies: 1509 1509
-- Name: aro_aco_key; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE UNIQUE INDEX aro_aco_key ON aros_acos USING btree (aro_id, aco_id);


--
-- TOC entry 1870 (class 0 OID 0)
-- Dependencies: 6
-- Name: public; Type: ACL; Schema: -; Owner: -
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2009-10-11 23:10:21 IST

--
-- PostgreSQL database dump complete
--


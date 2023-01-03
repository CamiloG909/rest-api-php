--
-- PostgreSQL database dump
--

-- Dumped from database version 13.3
-- Dumped by pg_dump version 14.0

-- Started on 2023-01-02 20:40:30

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

--
-- TOC entry 5 (class 2615 OID 38275)
-- Name: rest_api_php; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA rest_api_php;


ALTER SCHEMA rest_api_php OWNER TO postgres;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 232 (class 1259 OID 38278)
-- Name: category; Type: TABLE; Schema: rest_api_php; Owner: postgres
--

CREATE TABLE rest_api_php.category (
    id integer NOT NULL,
    name character varying NOT NULL,
    creation_date timestamp without time zone DEFAULT CURRENT_DATE NOT NULL
);


ALTER TABLE rest_api_php.category OWNER TO postgres;

--
-- TOC entry 231 (class 1259 OID 38276)
-- Name: categorias_id_seq; Type: SEQUENCE; Schema: rest_api_php; Owner: postgres
--

CREATE SEQUENCE rest_api_php.categorias_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE rest_api_php.categorias_id_seq OWNER TO postgres;

--
-- TOC entry 3080 (class 0 OID 0)
-- Dependencies: 231
-- Name: categorias_id_seq; Type: SEQUENCE OWNED BY; Schema: rest_api_php; Owner: postgres
--

ALTER SEQUENCE rest_api_php.categorias_id_seq OWNED BY rest_api_php.category.id;


--
-- TOC entry 234 (class 1259 OID 38290)
-- Name: product; Type: TABLE; Schema: rest_api_php; Owner: postgres
--

CREATE TABLE rest_api_php.product (
    id integer NOT NULL,
    title character varying NOT NULL,
    description text NOT NULL,
    creation_date timestamp without time zone DEFAULT CURRENT_DATE NOT NULL,
    id_category integer NOT NULL
);


ALTER TABLE rest_api_php.product OWNER TO postgres;

--
-- TOC entry 233 (class 1259 OID 38288)
-- Name: product_id_seq; Type: SEQUENCE; Schema: rest_api_php; Owner: postgres
--

CREATE SEQUENCE rest_api_php.product_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE rest_api_php.product_id_seq OWNER TO postgres;

--
-- TOC entry 3081 (class 0 OID 0)
-- Dependencies: 233
-- Name: product_id_seq; Type: SEQUENCE OWNED BY; Schema: rest_api_php; Owner: postgres
--

ALTER SEQUENCE rest_api_php.product_id_seq OWNED BY rest_api_php.product.id;


--
-- TOC entry 2933 (class 2604 OID 38281)
-- Name: category id; Type: DEFAULT; Schema: rest_api_php; Owner: postgres
--

ALTER TABLE ONLY rest_api_php.category ALTER COLUMN id SET DEFAULT nextval('rest_api_php.categorias_id_seq'::regclass);


--
-- TOC entry 2935 (class 2604 OID 38293)
-- Name: product id; Type: DEFAULT; Schema: rest_api_php; Owner: postgres
--

ALTER TABLE ONLY rest_api_php.product ALTER COLUMN id SET DEFAULT nextval('rest_api_php.product_id_seq'::regclass);


--
-- TOC entry 3072 (class 0 OID 38278)
-- Dependencies: 232
-- Data for Name: category; Type: TABLE DATA; Schema: rest_api_php; Owner: postgres
--

COPY rest_api_php.category (id, name, creation_date) FROM stdin;
1	Medicines	2021-01-04 13:46:06
2	Groceries	2021-01-04 13:46:06
\.


--
-- TOC entry 3074 (class 0 OID 38290)
-- Dependencies: 234
-- Data for Name: product; Type: TABLE DATA; Schema: rest_api_php; Owner: postgres
--

COPY rest_api_php.product (id, title, description, creation_date, id_category) FROM stdin;
1	Acetaminofen	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum varius, dolor sed malesuada molestie, risus magna ornare velit, vitae euismod turpis turpis fermentum sem. Donec maximus ligula non elit rutrum luctus. Nam id molestie massa, vitae vehicula ex. Integer ullamcorper justo quis odio porttitor venenatis. Fusce vel vulputate metus. Suspendisse auctor porttitor fermentum. Curabitur congue accumsan enim a faucibus. In purus nulla, blandit ut tristique id, vestibulum sit amet nibh. Suspendisse non mauris et lorem commodo suscipit.	2021-01-04 13:48:09	1
2	Coca cola 2	Class 2 aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer vel nisi dolor. Curabitur nec turpis id libero commodo viverra et a lorem. Cras eleifend sem non lorem ullamcorper vestibulum. Cras tempor ac tortor nec rutrum. Suspendisse sollicitudin vel purus ut volutpat.	2021-01-04 13:48:09	2
\.


--
-- TOC entry 3082 (class 0 OID 0)
-- Dependencies: 231
-- Name: categorias_id_seq; Type: SEQUENCE SET; Schema: rest_api_php; Owner: postgres
--

SELECT pg_catalog.setval('rest_api_php.categorias_id_seq', 1, false);


--
-- TOC entry 3083 (class 0 OID 0)
-- Dependencies: 233
-- Name: product_id_seq; Type: SEQUENCE SET; Schema: rest_api_php; Owner: postgres
--

SELECT pg_catalog.setval('rest_api_php.product_id_seq', 1, false);


--
-- TOC entry 2938 (class 2606 OID 38287)
-- Name: category categorias_pkey; Type: CONSTRAINT; Schema: rest_api_php; Owner: postgres
--

ALTER TABLE ONLY rest_api_php.category
    ADD CONSTRAINT categorias_pkey PRIMARY KEY (id);


--
-- TOC entry 2940 (class 2606 OID 38299)
-- Name: product product_pkey; Type: CONSTRAINT; Schema: rest_api_php; Owner: postgres
--

ALTER TABLE ONLY rest_api_php.product
    ADD CONSTRAINT product_pkey PRIMARY KEY (id);


-- Completed on 2023-01-02 20:40:31

--
-- PostgreSQL database dump complete
--

